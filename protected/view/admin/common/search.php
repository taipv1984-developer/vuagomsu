<div class="search pull-right">
    <form id="global_search" method="get" action="<?=$params['search_action']?>" class="cm-processed-form">
        <button class="icon-search cm-tooltip " type="submit" title="Search for product, customers, orders, CMS pages and site news!" id="search_button">
            Go
        </button>
        <label for="gs_text"><a><input type="text" class="cm-autocomplete-off" id="gs_text" name="<?=$params['search_name'] ?>" value="" autocomplete="off"></a></label>
    </form>
</div>