# Ounass_CustomCatalog
Custom catalog module to read, delete and update specific attributes and create new products.
Also, this module opens some rest api endpoints to read and update products
### Tested on magento community v-2.4.4

### Setup guid
1. Include this git repository to composer.json
```shell
"repositories": [
        {
            "url": "https://github.com/mamreezaa/module-custom-catalog.git",
            "type": "git"
        }
    ],
```
2. Download module
```shell
composer require ounass/module-custom-catalog dev-main
```
3. Install
```shell
bin/magento setup:upgrade
bin/magento setup:di:compile
```
4. Start the consumers
```shell
bin/magento queue:consumers:start CustomCatalogProductUpdate
bin/magento queue:consumers:start CustomCatalogDeadMessage
```

### Functions added in this module
1. Product Grid with vpn and copy_write_info added (including filter)
2. CRUD operation for products (store level)
3. Rest api for listing products by vpn
4. Rest api for asynchronously updates products for with attributes vpn and copy_write_info
5. Dead message exchange/queue for failed or timed out messages.


### REST Api requests
```shell
curl --location --request GET 'http://{base_url}/rest/default/V1/product/getByVPN/620317' \
--header 'Authorization: Bearer {token}'
```

```shell
curl --location --request PUT 'http://{base_url}/rest/default/V1/product/update' \
--header 'Authorization: Bearer {token}' \
--header 'Content-Type: application/json' \
--data-raw '{
    "product": {
        "entity_id": 2050,
        "copy_write_info": "AR",
        "vpn": "12345"
    }
}'
```
