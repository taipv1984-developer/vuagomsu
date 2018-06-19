<?php
class HomeCartController extends Controller{
	private $pluginCode;
	
	function __construct(){
		//get $pluginCode
		$actionControler = get_class($this);
		$pluginCodeMap = Session::getSession('pluginCodeMap');
		$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
// 		ProductExt::deleteSessionCart();
	}
	
	// OK
	public function cart() {
        $isMobile = Session::getSession('isMobile');
		if($isMobile){
            //get customerInfo and customerAddress (shipping address detail)
            $customerInfo = null;
            $customerAddressList = null;
            if(Session::isCustomerLogin()){
                $customerId = Session::getCustomerId();
                $customerInfo = CustomerExt::getCustomerInfo($customerId);
                $customerAddressList = CustomerExt::getCustomerAddressList($customerId);

                //set checkout_by_guest session
                CheckoutExt::setSession('checkout_by_guest', 0);
            }
            else{
                //set checkout_by_guest session
                CheckoutExt::setSession('checkout_by_guest', 1);
            }

            //send data
            $this->setAttributes(array(
                'customerInfo' => $customerInfo,
                'customerAddressList' => $customerAddressList,
                'cityList' => AddressHelper::getAllCity(242),
                'cartInfo' => ProductExt::getCartInfo(),
            ));

            //submit
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                CheckoutExt::checkoutSubmit();
                return $this->setRender('done');
            }

            //view
            return $this->setRender('success');
        }
        else{   //desktop
            //send data
            $this->setAttributes(array(
                'pluginCode' => $this->pluginCode,
                'cartInfo' => ProductExt::getCartInfo(),
            ));

            //view
            return $this->setRender('success');
        }
	}
	
   	/**
   	 * add_product in cart
   	 * update cart_popup
   	 */
    public function add_product(){
    	//get data
    	$productId = $_REQUEST['productId'];
    	$attributeValueId = $_REQUEST['attributeValueId'];
    	$quantity = $_REQUEST['quantity'];
    	
    	//add product to cart
    	ProductExt::setSessionCart($productId, $quantity, $attributeValueId);
    	
    	//update popup
    	$cartInfo = ProductExt::getCartInfo();
//     	$params = array(
//     		'pluginCode' => $this->pluginCode,
//     		'cartInfo' => $cartInfo,
//     	);
//     	TemplateHelper::getTemplate('common/cart/cart_popup.php', $params, $this->pluginCode);
    	
    	//echo totalItem
    	$totalItem = $cartInfo['totalItem'];
    	echo e("Giỏ hàng (%s)", $totalItem);
    	
		$this->setRender('success');
   	}
   
   	/**
   	 * change_quantity of product in cart
   	 * update cart_popup
   	 */
   	public function change_quantity(){
   		$productId = $_REQUEST['productId'];
   		$attributeValueId = $_REQUEST['attributeValueId'];
   		$quantity = $_REQUEST['quantity'];
   		
   		//update quantity
   		ProductExt::setSessionCart($productId, $quantity, $attributeValueId, false);
   		
   		//view
   		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Change product quantity is success');
   		$this->setRender('success');
   	}
   	
    /**
     * skip
   	 * recalculate all (quantity of) product in cart
   	 * update cart_popup
   	 */
    public function recalculate(){
    	//get data
    	$data = $_REQUEST['data'];
	   	
	   	//add product to cart
	   	foreach($data as $v){
	   		$productId = $v['productId'];
	   		$quantity = $v['quantity'];
	   		$attributeValueId = $v['attributeValueId'];
	   			
	   		ProductExt::setSessionCart($productId, $quantity, $attributeValueId, false);
	   	}
	   
	   	//update popup
   		$cartInfo = ProductExt::getCartInfo();
   		$params = array(
   			'pluginCode' => $this->pluginCode,
   			'cartInfo' => $cartInfo,
   		);
   		TemplateHelper::getTemplate('common/cart/cart_popup.php', $params, $this->pluginCode);
	   	
	   	$this->setRender('success');
    }

    /**
     * remove_product
     * after remove product out session then edit DOM by action (updatePopup || updatePage)
     * 		updatePopup appy for click .remove_product on popup
     * 		updatePage appy for click .remove_product on home/cart or home/orders (remove current row and update subTotal)
     */
    public function remove_product(){
	   	$productId = $_REQUEST['productId'];
	   	$attributeValueId = $_REQUEST['attributeValueId'];
	   	
	   	//remove_product
	   	ProductExt::deleteSessionCart($productId, $attributeValueId);
   			
	   	//view
	   	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Remove product is success');
	   	$this->setRender('success');
    }
   
    /**
     * skip
     * clear all product out cart after reload page
     */
    public function clear_cart(){
    	ProductExt::deleteSessionCart();
    	
    	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Clear cart is success');
    	$this->setRender('success');
   }
}