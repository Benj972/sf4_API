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
| Body | body | Use as login '_username: admin@example.com, _password: admin' for test API | Yes | [ Login ](#login) |


**Responses**

| Code | Description | Schema |
| ---- | ----------- | ------ |
| 200 | Successful operation | [ Token ](#token) |
| 400 | Bad Request: Method Not Allowed |  |
| 401 | Unauthorized: Bad credentials |  |
| 404 | Not Found: Invalid Route |  |

### Models
---

### Product  

| Name | Type |
| ---- | ---- | 
| id | integer |
| name | string | 
| date_create | dateTime |
| description | string |
| size | string |
| multimedia | string |
| networks | string |
| screen | string | 
| autonomy | string | 
| manufacturer | [Manufacturer](#manufacturer)|
| configurations | [ [Configuration](#configuration) ] | 

### Product2  

| Name | Type | 
| ---- | ---- | 
| name | string |

### User  

| Name | Type | 
| ---- | ---- |
| id | integer |
| email | string |
| lastname | string |
| firstname | string |

### User2  

| Name | Type |
| ---- | ---- |
| email | string |
| lastname | string |
| firstname | string |

### Manufacturer  

| Name | Type | 
| ---- | ---- |
| id | integer |
| name | string |

### Configuration  

| Name | Type |
| ---- | ---- | 
| id | integer | 
| color | string |
| memory | string |
| serial | string | 
| price | float | 
| images | [ [Image](#image) ] |

### Image  

| Name | Type | 
| ---- | ---- | 
| id | integer |
| url | string |

### Login
| Name | Type | 
| ---- | ---- |
| _username | string |
| _password | string |

### Token
| Name | Type | 
| ---- | ---- |
| token | string |