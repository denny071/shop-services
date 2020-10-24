<?php
namespace App\Services;

use App\Models\Product;
use App\SearchBuilders\ProductSearchBuilder;

class ProductService
{
    /**
     * getSimilarProductIds 获得详细商行平
     *
     * @param  mixed $product 商品
     * @param  mixed $amount 数量
     * @return void
     */
    public function getSimilarProductIds(Product $product, $amount)
    {
        // 如果商品没有商品属性，则直接返回空
        if (count($product->attributes) === 0) {
            return [];
        }
        $builder = (new ProductSearchBuilder())->onSale()->paginate($amount, 1);
        foreach ($product->attributes as $attribute) {
            $builder->propertyFilter($attribute->name, $attribute->value, 'should');
        }
        $builder->minShouldMatch(ceil(count($product->attributes) / 2));
        $params = $builder->getParams();
        $params['body']['query']['bool']['must_not'] = [['term' => ['_id' => $product->id]]];
        $result = app('es')->search($params);
        return collect($result['hits']['hits'])->pluck('_id')->all();
    }
}
