BileMo API
==========
Welcome to the BileMo API documentation

**Version:** 1.0.0

### /products/{id}
---
##### ***GET***
**Description:** Get one product.

**Parameters**

| Name | Located in | Description | Required | Schema |
| ---- | ---------- | ----------- | -------- | ---- |
| id | path | The product unique identifier. | Yes | integer |
| Authorization | header | Bearer Token | Yes | string |

**Responses**

| Code | Description | Schema |
| ---- | ----------- | ------ |
| 200 | successful operation | [Product](#product) |
| 400 | Bad Request: Method Not Allowed |  |
| 401 | Unauthorized: Expired JWT Token/JWT Token not found |  |
| 404 | Product object not found: Invalid ID supplied/Invalid Route |  |

### /products
---
##### ***GET***
**Description:** Get the list of products.

**Parameters**

| Name | Located in | Description | Required | Schema |
| ---- | ---------- | ----------- | -------- | ---- |
| name | query | Search product by name in list products | No | string |
| Authorization | header | Bearer Token | Yes | string |

**Responses**

| Code | Description | Schema |
| ---- | ----------- | ------ |
| 200 | successful operation | [Product](#product) |
| 400 | Bad Request: Method Not Allowed |  |
| 401 | Unauthorized: Expired JWT Token/JWT Token not found |  |
| 404 | Not Found: Invalid Route |  |

### /search
---
##### ***POST***
**Description:** Search product by Keyword.

**Parameters**

| Name | Located in | Description | Required | Schema |
| ---- | ---------- | ----------- | -------- | ---- |
| Authorization | header | Bearer Token | Yes | string |
| Body | body | Parameter name to add | Yes | [ [Product2](#product2) ] |

**Responses**

| Code | Description | Schema |
| ---- | ----------- | ------ |
| 201 | successful operation | [Product](#product) |
| 400 | Bad Request: Product is unavailable |  |
| 401 | Unauthorized: Expired JWT Token/JWT Token not found |  |
| 404 | Not Found: Invalid Route |  |

### /users/{id}
---
##### ***GET***
**Description:** Get one user.

**Parameters**

| Name | Located in | Description | Required | Schema |
| ---- | ---------- | ----------- | -------- | ---- |
| id | path | The user unique identifier. | Yes | integer |
| Authorization | header | Bearer Token | Yes | string |

**Responses**

| Code | Description | Schema |
| ---- | ----------- | ------ |
| 200 | Successful operation | [User](#user) |
| 400 | Bad Request: Method Not Allowed |  |
| 401 | Unauthorized: Expired JWT Token/JWT Token not found |  |
| 404 | User object not found: Invalid ID supplied/Invalid Route |  |

##### ***PUT***
**Description:** Update user

**Parameters**

| Name | Located in | Description | Required | Schema |
| ---- | ---------- | ----------- | -------- | ---- |
| id | path | The user unique identifier. | Yes | integer |
| Authorization | header | Bearer Token | Yes | string |
| Body | body | Change one or all property user | Yes | [ [User2](#user2) ] |

**Responses**

| Code | Description | Schema |
| ---- | ----------- | ------ |
| 201 | Successful operation | [User](#user) |
| 400 | Bad Request: Method Not Allowed |  |
| 401 | Unauthorized: Expired JWT Token/JWT Token not found |  |
| 404 | User object not found: Invalid ID supplied/Invalid Route |  |

##### ***DELETE***
**Description:** Delete user

**Parameters**

| Name | Located in | Description | Required | Schema |
| ---- | ---------- | ----------- | -------- | ---- |
| id | path | The user unique identifier. | Yes | integer |
| Authorization | header | Bearer Token | Yes | string |

**Responses**

| Code | Description |
| ---- | ----------- |
| 204 | Successful operation |
| 400 | Bad Request: Method Not Allowed |
| 401 | Unauthorized: Expired JWT Token/JWT Token not found |
| 404 | User object not found: Invalid ID supplied/Invalid Route |

### /users
---
##### ***GET***
**Description:** Get the list of users.

**Parameters**

| Name | Located in | Description | Required | Schema |
| ---- | ---------- | ----------- | -------- | ---- |
| Authorization | header | Bearer Token | Yes | string |

**Responses**

| Code | Description | Schema |
| ---- | ----------- | ------ |
| 200 | Successful operation | [User](#user) |
| 400 | Bad Request: Method Not Allowed |  |
| 401 | Unauthorized: Expired JWT Token/JWT Token not found |  |
| 404 | Not Found: Invalid Route |  |

##### ***POST***
**Description:** Create user

**Parameters**

| Name | Located in | Description | Required | Schema |
| ---- | ---------- | ----------- | -------- | ---- |
| Authorization | header | Bearer Token | Yes | string |
| Body | body | All property user to add | Yes | [ [User2](#user2) ] |

**Responses**

| Code | Description | Schema |
| ---- | ----------- | ------ |
| 201 | Successful operation | [User](#user) |
| 400 | Bad Request: Method Not Allowed |  |
| 401 | Unauthorized: Expired JWT Token/JWT Token not found |  |
| 404 | Not Found: Invalid Route |  |

### /api/login_check
---
##### ***POST***
**Description:** Authentication client and get access token

**Parameters**

| Name | Located in | Description | Required | Schema |
| ---- | ---------- | ----------- | -------- | ---- |
| Body | body | Use as login '_username: admin@example.com, _password: admintest' for test API | Yes | [ object ] |

**Responses**

| Code | Description | Schema |
| ---- | ----------- | ------ |
| 200 | Successful operation | [ object ](#object) |
| 400 | Bad Request: Method Not Allowed |  |
| 401 | Unauthorized: Bad credentials |  |
| 404 | Not Found: Invalid Route |  |

### Models
---

### Product  

| Name | Type | Description | Required |
| ---- | ---- | ----------- | -------- |
| id | integer |  | No |
| name | string |  | No |
| date_create | dateTime |  | No |
| description | string |  | No |
| size | string |  | No |
| multimedia | string |  | No |
| networks | string |  | No |
| screen | string |  | No |
| autonomy | string |  | No |
| manufacturer | [Manufacturer](#manufacturer) |  | No |
| configurations | [ [Configuration](#configuration) ] |  | No |

### Product2  

| Name | Type | Description | Required |
| ---- | ---- | ----------- | -------- |
| name | string |  | No |

### User  

| Name | Type | Description | Required |
| ---- | ---- | ----------- | -------- |
| id | integer |  | No |
| email | string |  | No |
| lastname | string |  | No |
| firstname | string |  | No |

### User2  

| Name | Type | Description | Required |
| ---- | ---- | ----------- | -------- |
| email | string |  | No |
| lastname | string |  | No |
| firstname | string |  | No |

### Manufacturer  

| Name | Type | Description | Required |
| ---- | ---- | ----------- | -------- |
| id | integer |  | No |
| name | string |  | No |

### Configuration  

| Name | Type | Description | Required |
| ---- | ---- | ----------- | -------- |
| id | integer |  | No |
| color | string |  | No |
| memory | string |  | No |
| serial | string |  | No |
| price | float |  | No |
| images | [ [Image](#image) ] |  | No |

### Image  

| Name | Type | Description | Required |
| ---- | ---- | ----------- | -------- |
| id | integer |  | No |
| url | string |  | No |

### Object
| Name | Type | Description | Required |
| _username | string |  | No |
| _password | string |  | No |
