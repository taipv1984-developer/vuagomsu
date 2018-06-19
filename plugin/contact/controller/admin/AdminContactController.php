<?php

class AdminContactController extends Controller {
    private $contactDao;
    public $contactModel;

    function __construct() {
        $this->contactDao = new ContactDao();
        $this->contactModel = new ContactModel();
    }

    private function _validate_add($addVo) {
        $validate = array();

//    	//the name should not duplicate in the table
//    	$contactVo = new ContactVo();
//    	$contactVo->name = $addVo->name;
//    	$contactVo->phone = $addVo->phone;
//    	$contactVos = $this->contactDao->selectByFilter($contactVo);
//    	if($contactVos){
//			$validate["contactModel.name"] = e("Contact have name and phone is exist");
//			$validate["contactModel.phone"] = e("Contact have name and phone is exist");
//    	}
//
        return $validate;
    }

    private function _validate_edit($editVo) {
        $validate = array();

        //the name should not duplicate in the table
//    	$contactVo = new ContactVo();
//    	$contactVo->name = $editVo->name;
//    	$contactVo->phone = $editVo->phone;
//    	$contactVos = $this->contactDao->selectByFilter($contactVo);
//    	if($contactVos){
//    		$contact = $contactVos[0];
//    		if($contact->contactId != $editVo->contactId) {
//    			$validate["contactModel.name"] = e("Contact have name and phone is exist");
//    			$validate["contactModel.phone"] = e("Contact have name and phone is exist");
//			}
//    	}

        return $validate;
    }

    private function _add_info($contactVo) {
        //crtDate
        $contactVo->crtDate = "<b>". date('d/m/Y', strtotime($contactVo->crtDate)) ."</b> <i>". date('H:i', strtotime($contactVo->crtDate)) ."</i>";
        $contactVo->regionShortName = ArrayHelper::getRegionShortNameList()[$contactVo->region];
    }

    private function _filter($contactVo) {
        if (!CTTHelper::isEmptyString($this->contactModel->contactId)) {
            $contactVo->contactId = $this->contactModel->contactId;
        }
        if (!CTTHelper::isEmptyString($this->contactModel->trainerId)) {
            $contactVo->trainerId = $this->contactModel->trainerId;
        }
        if (!CTTHelper::isEmptyString($this->contactModel->crtDate)) {
            $crtDate = $this->contactModel->crtDate;
            $exp = explode('/', $crtDate);
            $crtDate = date('Y-m-d', strtotime($exp[2] . '-' . $exp[1] . '-' . $exp[0]));    //ham vai von ~ ~
            $contactVo->crtDate = array('like', "%{$crtDate}%");
        }
        if (!CTTHelper::isEmptyString($this->contactModel->name)) {
            $contactVo->name = array('like', "%{$this->contactModel->name}%");
        }
        if (!CTTHelper::isEmptyString($this->contactModel->phone)) {
            $contactVo->phone = array('like', "%{$this->contactModel->phone}%");
        }
        if (!CTTHelper::isEmptyString($this->contactModel->email)) {
            $contactVo->email = array('like', "%{$this->contactModel->email}%");
        }
        if (!CTTHelper::isEmptyString($this->contactModel->note)) {
            $contactVo->note = array('like', "%{$this->contactModel->note}%");
        }
        if (!CTTHelper::isEmptyString($this->contactModel->status)) {
            $contactVo->status = $this->contactModel->status;
        }
        if (!CTTHelper::isEmptyString($this->contactModel->source)) {
            $contactVo->source = $this->contactModel->source;
        }
        if (!CTTHelper::isEmptyString($_REQUEST['contactModel_regionShortName'])) {
            $contactVo->region = $_REQUEST['contactModel_regionShortName'];
        }
    }

    public function manage() {
        $contactVo = new ContactVo();

        //filter
        $this->_filter($contactVo);

        //orderby
        $orderBy = array('contact_id' => 'DESC');

        //paging
        if (empty($_REQUEST['item_per_page'])) {
            $recSize = Registry::getSetting('item_per_page');
        } else {
            $recSize = $_REQUEST['item_per_page'];
        }
        $start = 0;
        if (CTTHelper::isEmptyString($_REQUEST ['page'])) {
            $page = 0;
        } elseif (is_numeric($_REQUEST ['page'])) {
            $page = $_REQUEST ['page'];
        } else {
            $page = 0;
        }
        $count = count($this->contactDao->selectByFilter($contactVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;

        //get data
        $contactVos = $this->contactDao->selectByFilter($contactVo, $orderBy, $start, $recSize);

        //add info
        foreach ($contactVos as $contactVo) {
            $this->_add_info($contactVo);
        }

        //set data
        $paging->items = $contactVos;

        //send data
        $this->setAttributes(array(
            'pageView' => $paging,
            'trainerArray' => TrainerExt::getTrainerArray(),
        ));

        //call view
        return $this->setRender('success');
    }

    public function change_trainer() {
        $contactId = $_REQUEST['id'];
        $trainerId = $_REQUEST['value'];
        $contactVo = new ContactVo();
        $contactVo->trainerId = $trainerId;
        $this->contactDao->updateByPrimaryKey($contactVo, $contactId);
        return $this->setRender('success');
    }

    public function change_status() {
        $contactId = $_REQUEST['id'];
        $status = $_REQUEST['value'];
        $contactVo = new ContactVo();
        $contactVo->status = $status;
        $this->contactDao->updateByPrimaryKey($contactVo, $contactId);
        return $this->setRender('success');
    }

    public function change_source() {
        $contactId = $_REQUEST['id'];
        $source = $_REQUEST['value'];
        $contactVo = new ContactVo();
        $contactVo->source = $source;
        $this->contactDao->updateByPrimaryKey($contactVo, $contactId);
        return $this->setRender('success');
    }

    public function validate_ajax() {
        $action = $_REQUEST['action'];
        switch ($action) {
            case 'add':
                $contactVo = new ContactVo();
                $contactVo->name = trim($_REQUEST['name']);
                $contactVo->phone = trim($_REQUEST['phone']);
                $validate = $this->_validate_add($contactVo);
                if (!empty($validate)) {
                    echo json_encode($validate);
                }
                break;
            case 'edit':
                $contactVo = new ContactVo();
                $contactVo->name = trim($_REQUEST['name']);
                $contactVo->phone = trim($_REQUEST['phone']);
                $contactVo->contactId = $_REQUEST['contactId'];
                $validate = $this->_validate_edit($contactVo);
                if (!empty($validate)) {
                    echo json_encode($validate);
                }
                break;
        }

        return $this->setRender('success');
    }

    private function _check_exist($contactInfo) {
        if (!$contactInfo) {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Contact not exist');
            return false;
        }
        return true;
    }

    private function _check_permission($contactInfo) {
        return true;
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //set data
            $contactVo = new ContactVo();
            CTTHelper::copyProperties($this->contactModel, $contactVo);
            //default
            $contactVo->crtBy = Session::getAdminId();
            $contactVo->crtDate = DateHelper::getDate();

            //add
            $this->contactDao->insert($contactVo);

            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Contact add success");
            return $this->setRender('manage');
        }

        //send data
        $this->setAttributes(array(
            'isAction' => true,
            'trainerArray' => TrainerExt::getTrainerArray(),
        ));

        return $this->setRender('success');
    }

    public function edit() {
        $contactId = $_REQUEST['contactId'];
        $contactInfo = $this->contactDao->selectByPrimaryKey($contactId);

        if (!($this->_check_exist($contactInfo) & $this->_check_permission($contactInfo))) {
            return $this->setRender('manage');
        }

        //add info
        $this->_add_info($contactInfo);

        //send data
        $this->setAttributes(array(
            'contactInfo' => $contactInfo,
            'isAction' => true,
            'trainerArray' => TrainerExt::getTrainerArray(),
        ));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //set data
            $contactVo = new ContactVo();
            CTTHelper::copyProperties($this->contactModel, $contactVo);

            //update
            $this->contactDao->updateByPrimaryKey($contactVo, $contactId);

            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Contact update success");
            return $this->setRender('manage');
        }

        return $this->setRender('success');
    }

    public function delete() {
        if (isset($_REQUEST['contactId'])) {
            $contactId = $_REQUEST['contactId'];

            $this->contactDao->deleteByPrimaryKey($contactId);
            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
        }
        return $this->setRender('success');
    }

    /********************************************
     * MORE ACTION
     *******************************************/
    public function import() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //get all contact old
            $contactList = $this->contactDao->selectAll();
            $contactPhone = array();
            foreach ($contactList as $v) {
                $contactPhone[] = trim($v->phone);
            }

            //get file upload
            $tmpfname = $_FILES['file']['tmp_name'];

            //PHPExcel
            require_once LIBRARY_PATH.'PHPExcel/Classes/PHPExcel.php';
            $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
            $excelObj = $excelReader->load($tmpfname);
            $worksheet = $excelObj->getSheet(0);
            $lastRow = $worksheet->getHighestRow();

            $sourceR = ArrayHelper::getContactSourceR();
            $statusR = ArrayHelper::getContactStatusR();

            //get data (next first row)
            for ($row = 2; $row <= $lastRow; $row++) {
                $crtDate = $worksheet->getCell('A' . $row)->getValue();
                $source = $worksheet->getCell('B' . $row)->getValue();
                $name = $worksheet->getCell('C' . $row)->getValue();
                $phone = $worksheet->getCell('D' . $row)->getValue();
                $email = $worksheet->getCell('E' . $row)->getValue();
                $status = $worksheet->getCell('F' . $row)->getValue();
                $note = $worksheet->getCell('G' . $row)->getValue();

                //define again data
                if ($crtDate != '') {
                    //$crtDate		d/m/Y -> Y-m-d	h:i:s
                    $exp = explode(' ', $crtDate);
                    $dmY = trim($exp[0]);
                    $his = (isset($exp[1])) ? trim($exp[1]) : '00:00:00';
                    $exp_dmY = explode('/', $dmY);
                    $day = trim($exp_dmY[0]);
                    $month = trim($exp_dmY[1]);
                    $year = (isset($exp_dmY[2])) ? $exp_dmY[2] : date('Y');
                    $exp_his = explode(':', $his);
                    $house = (isset($exp_his[0])) ? $exp_his[0] : '00';
                    $munite = (isset($exp_his[1])) ? $exp_his[1] : '00';
                    $second = (isset($exp_his[2])) ? $exp_his[2] : '00';
                    $crtDate = $year . "-" . $month . "-" . $day . " " . $house . ":" . $munite . ":" . $second;
                    //$source
                    $source = (isset($sourceR[$source])) ? $sourceR[$source] : 'O';
                    //$status
                    $status = (isset($statusR[$status])) ? $statusR[$status] : 'P';

                    //insert to db
                    if (!in_array($phone, $contactPhone)) {    //skip contact have phone sample
                        $contactVo = new ContactVo();
                        $contactVo->crtDate = $crtDate;
                        $contactVo->source = $source;
                        $contactVo->name = $name;
                        $contactVo->phone = $phone;
                        $contactVo->email = $email;
                        $contactVo->status = $status;
                        $contactVo->note = $note;
                        $this->contactDao->insert($contactVo);
                    } else {    //save log
                        //skip
                    }
                } else {
                    break;
                }
            }

            //message
            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Import contact is success!');
        }

        return $this->setRender('manage');
    }

    public function export() {
        /** Error reporting */
        error_reporting(E_ALL);

        /** Include path **/
        $include_path = LIBRARY_PATH.'PHPExcel/Classes/';
        ini_set('include_path', $include_path);

        /** PHPExcel */
        include 'PHPExcel.php';

        /** PHPExcel_Writer_Excel2007 */
        include 'PHPExcel/Writer/Excel2007.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        /**********
         * GET DATA
         **********/
        $contactList = $this->contactDao->selectAll();
        //format data
        $contactSource = ArrayHelper::getContactSource();
        $contactStatus = ArrayHelper::getContactStatus();
        foreach ($contactList as $v) {
            $v->crtDate = date('d/m/Y H:i:s', strtotime($v->crtDate));
            $v->crtDate = str_replace(' 00:00:00', '', $v->crtDate);
            $v->source = $contactSource[$v->source];
            $v->status = $contactStatus[$v->status];
            $v->phone = '' . $v->phone;
        }

        /*****************************************
         * Sheet 1
         *****************************************/
        $iSheet = 0;
        //Active sheet
        $objPHPExcel->setActiveSheetIndex($iSheet);
        //sheet title
        $objPHPExcel->getActiveSheet()->setTitle("Contact export");
        $irow = 1;

        $column_map = array(
            'A' => array('title' => 'Timestamp', 'width' => 25),
            'B' => array('title' => 'Source', 'width' => 15),
            'C' => array('title' => 'Fullname', 'width' => 20),
            'D' => array('title' => 'Mobile', 'width' => 20),
            'E' => array('title' => 'Email', 'width' => 20),
            'F' => array('title' => 'Status', 'width' => 20),
            'G' => array('title' => 'Note', 'width' => 60),
        );

        //Set width column
        foreach ($column_map as $key => $value) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value['width']);
        }

        //Set column title
        foreach ($column_map as $key => $value) {
            $cell = "$key" . "$irow";
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getRowDimension($irow)->setRowHeight(25);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => 'f7f7f7'
                )
            ));
            $objPHPExcel->getActiveSheet()->SetCellValue($cell, $value['title']);
        }

        //fill data
        foreach ($contactList as $v) {
            $irow++;
            //crtDate
            $cell = "A$irow";
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(false);
            $objPHPExcel->getActiveSheet()->SetCellValue($cell, $v->crtDate);
            //source
            $cell = "B$irow";
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(false);
            $objPHPExcel->getActiveSheet()->SetCellValue($cell, $v->source);
            //name
            $cell = "C$irow";
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(false);
            $objPHPExcel->getActiveSheet()->SetCellValue($cell, $v->name);
            //phone
            $cell = "D$irow";
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(false);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->SetCellValue($cell, $v->phone);
            //email
            $cell = "E$irow";
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(false);
            $objPHPExcel->getActiveSheet()->SetCellValue($cell, $v->email);
            //status
            $cell = "F$irow";
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(false);
            $objPHPExcel->getActiveSheet()->SetCellValue($cell, $v->status);
            //note
            $cell = "G$irow";
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(false);
            $objPHPExcel->getActiveSheet()->SetCellValue($cell, $v->note);
        }
        //add sheet
        $objPHPExcel->createSheet(NULL, $iSheet);
        $iSheet++;

        //return first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Set properties
        //echo date('H:i:s') . " Set properties<br>";
        $objPHPExcel->getProperties()->setCreator("VDato Solutions");
        $objPHPExcel->getProperties()->setLastModifiedBy("TaiPV");
        $objPHPExcel->getProperties()->setTitle("Export contact for KBE.Fitness");
        $objPHPExcel->getProperties()->setSubject("Export contact for KBE.Fitness");
        $objPHPExcel->getProperties()->setDescription("VDato Solutions");

        // Save Excel 2007 file
        $date = date('Y-m-d');
        $file_name = "Contact-Export [$date].xlsx";

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$file_name");
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

        return $this->setRender('manage');
    }
}