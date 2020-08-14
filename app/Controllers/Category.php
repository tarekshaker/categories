<?php


namespace App\Controllers;


class Category extends BaseController
{

    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new \CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        $data['categories'] = $categories;
        return view('categories', $data);
    }

    public function addSubCategory($id)
    {
        $getCategory = $this->categoryModel->find($id);
        $parentId = $getCategory['parent_id'];
        $parentName = $getCategory ['name'];
        $lastSubCategoryId = $this->categoryModel->checkSecondSubCategory($parentId);

        if ($lastSubCategoryId == $id) {
            $new_subCategories = [
                [
                    'name' => 'Sub ' . $parentName . '-1',
                    'parent_id' => $id
                ],
                [
                    'name' => 'Sub ' . $parentName . '-2',
                    'parent_id' => $id
                ]
            ];

            $insertSubCategories = $this->categoryModel->insertSubCategories($new_subCategories);

            if ($insertSubCategories == 1) {
                $getInsertedSubCategories = $this->categoryModel->getSubCategories($id);
                $output = '<select name="subCategory' . $id . '" id="subCategory' . $id . '" class="category form-control input-lg"> ';
                $output .= '<option value="">Select SubCategory</option>';

                foreach ($getInsertedSubCategories as $category) {
                    $output .= '<option value="' . $category->id . '">' . $category->name . '</option>';
                }

                $output .= '</select>';

                $result['message'] = 'Subcategories added successfully';
                $result['output'] = $output;

            }else{
                $result['message'] = 'This category already have subcategories';
            }
        } else {
            $result['message'] = 'Can not generate child to first parent';
        }

        return json_encode($result);


    }


}