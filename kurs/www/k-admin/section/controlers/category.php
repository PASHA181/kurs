<?php



    $model = new Models_Catalog;
    $catalog = array();

    $model->category_id = K::get('category')->getCategoryList($category_id); // пять - id категории
    $model->category_id[] = $category_id;

    $catalog = $model->getList($page, 5);

    //категории:

    $listCategories = K::get('category')->getCategoryTitleList();
    $arrayCategories = $model->category_id = K::get('category')->getHierarchyCategory(0);


    $categories.= "<ul id='category-tree'>";
    $categories.= K::get('category')->getCategoryListUl(0,'admin');
    $categories.= "</ul>";



    $pagination = $catalog['pagination'];
    unset($catalog['pagination']);


    $select_categories = "<select id='category_edit_select' name='select_parent_category'>";
    $select_categories.="<option selected value='0'>Все</option>";
    $select_categories.=K::get('category')->getTitleCategory($arrayCategories);
    $select_categories.="</select>";

$this->select_categories=$select_categories;
$this->categories=$categories;

