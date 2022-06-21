# Ounass_CustomCatalog

### Installation
1. Include this git repository to composer.json
```shell
"repositories": [
        {
            "url": "https://github.com/mamreezaa/module-custom-catalog.git",
            "type": "git"
        }
    ],
```
2. Install module
```shell
composer require ounass/module-custom-catalog dev-main
```
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
