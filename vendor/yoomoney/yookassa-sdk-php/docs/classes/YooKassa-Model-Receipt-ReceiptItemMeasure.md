# [YooKassa API SDK](../home.md)

# Class: \YooKassa\Model\Receipt\ReceiptItemMeasure
### Namespace: [\YooKassa\Model\Receipt](../namespaces/yookassa-model-receipt.md)
---
**Summary:**

Мера количества предмета расчета передается в массиве `items`, в параметре `measure`.

**Description:**

Параметр нужно передавать, начиная с ФФД 1.2.

---
### Constants
| Visibility | Name | Flag | Summary |
| ----------:| ---- | ---- | ------- |
| public | [PIECE](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_PIECE) |  |  |
| public | [GRAM](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_GRAM) |  |  |
| public | [KILOGRAM](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_KILOGRAM) |  |  |
| public | [TON](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_TON) |  |  |
| public | [CENTIMETER](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_CENTIMETER) |  |  |
| public | [DECIMETER](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_DECIMETER) |  |  |
| public | [METER](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_METER) |  |  |
| public | [SQUARE_CENTIMETER](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_SQUARE_CENTIMETER) |  |  |
| public | [SQUARE_DECIMETER](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_SQUARE_DECIMETER) |  |  |
| public | [SQUARE_METER](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_SQUARE_METER) |  |  |
| public | [MILLILITER](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_MILLILITER) |  |  |
| public | [LITER](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_LITER) |  |  |
| public | [CUBIC_METER](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_CUBIC_METER) |  |  |
| public | [KILOWATT_HOUR](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_KILOWATT_HOUR) |  |  |
| public | [GIGACALORIE](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_GIGACALORIE) |  |  |
| public | [DAY](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_DAY) |  |  |
| public | [HOUR](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_HOUR) |  |  |
| public | [MINUTE](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_MINUTE) |  |  |
| public | [SECOND](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_SECOND) |  |  |
| public | [KILOBYTE](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_KILOBYTE) |  |  |
| public | [MEGABYTE](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_MEGABYTE) |  |  |
| public | [GIGABYTE](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_GIGABYTE) |  |  |
| public | [TERABYTE](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_TERABYTE) |  |  |
| public | [ANOTHER](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#constant_ANOTHER) |  |  |

---
### Properties
| Visibility | Name | Flag | Summary |
| ----------:| ---- | ---- | ------- |
| protected | [$validValues](../classes/YooKassa-Model-Receipt-ReceiptItemMeasure.md#property_validValues) |  |  |

---
### Methods
| Visibility | Name | Flag | Summary |
| ----------:| ---- | ---- | ------- |
| public | [getEnabledValues()](../classes/YooKassa-Common-AbstractEnum.md#method_getEnabledValues) |  | Возвращает значения в enum'е значения которых разрешены |
| public | [getValidValues()](../classes/YooKassa-Common-AbstractEnum.md#method_getValidValues) |  | Возвращает все значения в enum'e |
| public | [valueExists()](../classes/YooKassa-Common-AbstractEnum.md#method_valueExists) |  | Проверяет наличие значения в enum'e |

---
### Details
* File: [lib/Model/Receipt/ReceiptItemMeasure.php](../../lib/Model/Receipt/ReceiptItemMeasure.php)
* Package: Default
* Class Hierarchy: 
  * [\YooKassa\Common\AbstractEnum](../classes/YooKassa-Common-AbstractEnum.md)
  * \YooKassa\Model\Receipt\ReceiptItemMeasure

---
## Constants
<a name="constant_PIECE" class="anchor"></a>
###### PIECE
```php
PIECE = 'piece' : string
```


<a name="constant_GRAM" class="anchor"></a>
###### GRAM
```php
GRAM = 'gram' : string
```


<a name="constant_KILOGRAM" class="anchor"></a>
###### KILOGRAM
```php
KILOGRAM = 'kilogram' : string
```


<a name="constant_TON" class="anchor"></a>
###### TON
```php
TON = 'ton' : string
```


<a name="constant_CENTIMETER" class="anchor"></a>
###### CENTIMETER
```php
CENTIMETER = 'centimeter' : string
```


<a name="constant_DECIMETER" class="anchor"></a>
###### DECIMETER
```php
DECIMETER = 'decimeter' : string
```


<a name="constant_METER" class="anchor"></a>
###### METER
```php
METER = 'meter' : string
```


<a name="constant_SQUARE_CENTIMETER" class="anchor"></a>
###### SQUARE_CENTIMETER
```php
SQUARE_CENTIMETER = 'square_centimeter' : string
```


<a name="constant_SQUARE_DECIMETER" class="anchor"></a>
###### SQUARE_DECIMETER
```php
SQUARE_DECIMETER = 'square_decimeter' : string
```


<a name="constant_SQUARE_METER" class="anchor"></a>
###### SQUARE_METER
```php
SQUARE_METER = 'square_meter' : string
```


<a name="constant_MILLILITER" class="anchor"></a>
###### MILLILITER
```php
MILLILITER = 'milliliter' : string
```


<a name="constant_LITER" class="anchor"></a>
###### LITER
```php
LITER = 'liter' : string
```


<a name="constant_CUBIC_METER" class="anchor"></a>
###### CUBIC_METER
```php
CUBIC_METER = 'cubic_meter' : string
```


<a name="constant_KILOWATT_HOUR" class="anchor"></a>
###### KILOWATT_HOUR
```php
KILOWATT_HOUR = 'kilowatt_hour' : string
```


<a name="constant_GIGACALORIE" class="anchor"></a>
###### GIGACALORIE
```php
GIGACALORIE = 'gigacalorie' : string
```


<a name="constant_DAY" class="anchor"></a>
###### DAY
```php
DAY = 'day' : string
```


<a name="constant_HOUR" class="anchor"></a>
###### HOUR
```php
HOUR = 'hour' : string
```


<a name="constant_MINUTE" class="anchor"></a>
###### MINUTE
```php
MINUTE = 'minute' : string
```


<a name="constant_SECOND" class="anchor"></a>
###### SECOND
```php
SECOND = 'second' : string
```


<a name="constant_KILOBYTE" class="anchor"></a>
###### KILOBYTE
```php
KILOBYTE = 'kilobyte' : string
```


<a name="constant_MEGABYTE" class="anchor"></a>
###### MEGABYTE
```php
MEGABYTE = 'megabyte' : string
```


<a name="constant_GIGABYTE" class="anchor"></a>
###### GIGABYTE
```php
GIGABYTE = 'gigabyte' : string
```


<a name="constant_TERABYTE" class="anchor"></a>
###### TERABYTE
```php
TERABYTE = 'terabyte' : string
```


<a name="constant_ANOTHER" class="anchor"></a>
###### ANOTHER
```php
ANOTHER = 'another' : string
```



---
## Properties
<a name="property_validValues"></a>
#### protected $validValues : array
---
**Type:** <a href="../array"><abbr title="array">array</abbr></a>
Массив принимаемых enum&#039;ом значений
**Details:**



---
## Methods
<a name="method_getEnabledValues" class="anchor"></a>
#### public getEnabledValues() : string[]

```php
Static public getEnabledValues() : string[]
```

**Summary**

Возвращает значения в enum'е значения которых разрешены

**Details:**
* Inherited From: [\YooKassa\Common\AbstractEnum](../classes/YooKassa-Common-AbstractEnum.md)

**Returns:** string[] - Массив разрешённых значений


<a name="method_getValidValues" class="anchor"></a>
#### public getValidValues() : array

```php
Static public getValidValues() : array
```

**Summary**

Возвращает все значения в enum'e

**Details:**
* Inherited From: [\YooKassa\Common\AbstractEnum](../classes/YooKassa-Common-AbstractEnum.md)

**Returns:** array - Массив значений в перечислении


<a name="method_valueExists" class="anchor"></a>
#### public valueExists() : bool

```php
Static public valueExists(mixed $value) : bool
```

**Summary**

Проверяет наличие значения в enum'e

**Details:**
* Inherited From: [\YooKassa\Common\AbstractEnum](../classes/YooKassa-Common-AbstractEnum.md)

##### Parameters:
| Type | Name | Description |
| ---- | ---- | ----------- |
| <code lang="php">mixed</code> | value  | Проверяемое значение |

**Returns:** bool - True если значение имеется, false если нет



---

### Top Namespaces

* [\YooKassa](../namespaces/yookassa.md)

---

### Reports
* [Errors - 0](../reports/errors.md)
* [Markers - 0](../reports/markers.md)
* [Deprecated - 23](../reports/deprecated.md)

---

This document was automatically generated from source code comments on 2023-03-09 using [phpDocumentor](http://www.phpdoc.org/)

&copy; 2023 YooMoney