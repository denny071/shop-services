# 商城微服务

```

├── shop-admin                  # 商城管理后台
├── shop-comment-api            # 商城评论API
├── shop-docker                 
├── shop-logistics-api
├── shop-order-api
├── shop-payment-api
├── shop-product-api
├── shop-search-api
├── shop-shoppingcart-api
└── shop-user-api

```

构建admin 

```
composer create-project --prefer-dist laravel/laravel admin

composer require dcat/laravel-admin 
composer require predis/predis
composer require elasticsearch/elasticsearch

```
