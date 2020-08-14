<?php

use \CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'parent_id'];

    public function getCategories()
    {
        $categories = $this->groupBy('parent_id')->get()->getResultArray();
        $distinctParents = array_map(function ($value) {
            return $value['parent_id'];
        }, $categories);

        $html = '';

        foreach ($distinctParents as $parent) {
            $subCategories = $this->where('parent_id', $parent)->get()->getResultArray();
            $html .= '<select class="category form-control input-lg">';
            $html .= '<option value="" disabled selected>Select Category</option>';
            foreach ($subCategories as $subCat) {
                $html .= '<option value="' . $subCat['id'] . '">' . $subCat['name'] . '</option>';
            }
            $html .= '</select>';

        }
        return $html;
    }

    public function checkSecondSubCategory($parentId)
    {
        return $this->where('parent_id', $parentId)->orderBy('id', 'Desc')->first()['id'];
    }

    public function insertSubCategories($subCategories)
    {
        $checkSubCategories = $this->where('parent_id', $subCategories[0]['parent_id'])->get()->getResultArray();
        if (count($checkSubCategories) === 0) {
            $this->insertBatch($subCategories);
            return true;
        }
        return false;
    }

    public function getSubCategories($parentId)
    {
        return $this->where('parent_id', $parentId)->get()->getResult();
    }
}