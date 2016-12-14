<?
$model = new Models_Catalog;
$catalog = array();

//получаем все вложенные ID подкатегорий
$model->categoryId = K::get('category')->getCategoryList(URL::get('category_id')); // пять - id категории
//дописываем в массив id категорий, выбраную категорию
$model->categoryId[] = URL::get('category_id');

$catalog = $model->getList(URL::get('page'));
//K::loger(print_r($catalog, true));
//категории:

$listCategories = K::get('category')->getCategoryTitleList();
$arrayCategories = $model->categoryId = K::get('category')->getHierarchyCategory(0);

$categories  = '<select id="category_select" name="category">';
$categories .= '<option selected value="0">Все</option>';
$categories .= K::get('category')->getTitleCategory($arrayCategories, URL::get('category_id'));
$categories .= '</select>';

$pagination = $catalog['pagination'];
unset($catalog['pagination']);


$this->catalog = $catalog;
$this->listCategories = $listCategories;
$this->categories = $categories;
$this->pagination = $pagination;
$this->arrayCategories = $arrayCategories;
