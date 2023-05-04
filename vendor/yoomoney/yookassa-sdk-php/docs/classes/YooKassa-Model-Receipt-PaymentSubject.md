# [YooKassa API SDK](../home.md)

# Class: \YooKassa\Model\Receipt\PaymentSubject
### Namespace: [\YooKassa\Model\Receipt](../namespaces/yookassa-model-receipt.md)
---
**Summary:**

Признак предмета расчета передается в параметре `payment_subject`.


---
### Constants
| Visibility | Name | Flag | Summary |
| ----------:| ---- | ---- | ------- |
| public | [COMMODITY](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_COMMODITY) |  |  |
| public | [EXCISE](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_EXCISE) |  |  |
| public | [JOB](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_JOB) |  |  |
| public | [SERVICE](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_SERVICE) |  |  |
| public | [GAMBLING_BET](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_GAMBLING_BET) |  |  |
| public | [GAMBLING_PRIZE](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_GAMBLING_PRIZE) |  |  |
| public | [LOTTERY](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_LOTTERY) |  |  |
| public | [LOTTERY_PRIZE](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_LOTTERY_PRIZE) |  |  |
| public | [INTELLECTUAL_ACTIVITY](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_INTELLECTUAL_ACTIVITY) |  |  |
| public | [PAYMENT](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_PAYMENT) |  |  |
| public | [AGENT_COMMISSION](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_AGENT_COMMISSION) |  |  |
| public | [PROPERTY_RIGHT](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_PROPERTY_RIGHT) |  |  |
| public | [NON_OPERATING_GAIN](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_NON_OPERATING_GAIN) |  |  |
| public | [INSURANCE_PREMIUM](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_INSURANCE_PREMIUM) |  |  |
| public | [SALES_TAX](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_SALES_TAX) |  |  |
| public | [RESORT_FEE](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_RESORT_FEE) |  |  |
| public | [COMPOSITE](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_COMPOSITE) |  |  |
| public | [ANOTHER](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_ANOTHER) |  |  |
| public | [FINE](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_FINE) |  |  |
| public | [TAX](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_TAX) |  |  |
| public | [LIEN](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_LIEN) |  |  |
| public | [COST](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_COST) |  |  |
| public | [PENSION_INSURANCE_WITHOUT_PAYOUTS](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_PENSION_INSURANCE_WITHOUT_PAYOUTS) |  |  |
| public | [PENSION_INSURANCE_WITH_PAYOUTS](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_PENSION_INSURANCE_WITH_PAYOUTS) |  |  |
| public | [HEALTH_INSURANCE_WITHOUT_PAYOUTS](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_HEALTH_INSURANCE_WITHOUT_PAYOUTS) |  |  |
| public | [HEALTH_INSURANCE_WITH_PAYOUTS](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_HEALTH_INSURANCE_WITH_PAYOUTS) |  |  |
| public | [HEALTH_INSURANCE](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_HEALTH_INSURANCE) |  |  |
| public | [CASINO](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_CASINO) |  |  |
| public | [AGENT_WITHDRAWALS](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_AGENT_WITHDRAWALS) |  |  |
| public | [NON_MARKED_EXCISE](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_NON_MARKED_EXCISE) |  |  |
| public | [MARKED_EXCISE](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_MARKED_EXCISE) |  |  |
| public | [MARKED](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_MARKED) |  |  |
| public | [NON_MARKED](../classes/YooKassa-Model-Receipt-PaymentSubject.md#constant_NON_MARKED) |  |  |

---
### Properties
| Visibility | Name | Flag | Summary |
| ----------:| ---- | ---- | ------- |
| protected | [$validValues](../classes/YooKassa-Model-Receipt-PaymentSubject.md#property_validValues) |  |  |

---
### Methods
| Visibility | Name | Flag | Summary |
| ----------:| ---- | ---- | ------- |
| public | [getEnabledValues()](../classes/YooKassa-Common-AbstractEnum.md#method_getEnabledValues) |  | Возвращает значения в enum'е значения которых разрешены |
| public | [getValidValues()](../classes/YooKassa-Common-AbstractEnum.md#method_getValidValues) |  | Возвращает все значения в enum'e |
| public | [valueExists()](../classes/YooKassa-Common-AbstractEnum.md#method_valueExists) |  | Проверяет наличие значения в enum'e |

---
### Details
* File: [lib/Model/Receipt/PaymentSubject.php](../../lib/Model/Receipt/PaymentSubject.php)
* Package: Default
* Class Hierarchy: 
  * [\YooKassa\Common\AbstractEnum](../classes/YooKassa-Common-AbstractEnum.md)
  * \YooKassa\Model\Receipt\PaymentSubject

---
## Constants
<a name="constant_COMMODITY" class="anchor"></a>
###### COMMODITY
```php
COMMODITY = 'commodity' : string
```


<a name="constant_EXCISE" class="anchor"></a>
###### EXCISE
```php
EXCISE = 'excise' : string
```


<a name="constant_JOB" class="anchor"></a>
###### JOB
```php
JOB = 'job' : string
```


<a name="constant_SERVICE" class="anchor"></a>
###### SERVICE
```php
SERVICE = 'service' : string
```


<a name="constant_GAMBLING_BET" class="anchor"></a>
###### GAMBLING_BET
```php
GAMBLING_BET = 'gambling_bet' : string
```


<a name="constant_GAMBLING_PRIZE" class="anchor"></a>
###### GAMBLING_PRIZE
```php
GAMBLING_PRIZE = 'gambling_prize' : string
```


<a name="constant_LOTTERY" class="anchor"></a>
###### LOTTERY
```php
LOTTERY = 'lottery' : string
```


<a name="constant_LOTTERY_PRIZE" class="anchor"></a>
###### LOTTERY_PRIZE
```php
LOTTERY_PRIZE = 'lottery_prize' : string
```


<a name="constant_INTELLECTUAL_ACTIVITY" class="anchor"></a>
###### INTELLECTUAL_ACTIVITY
```php
INTELLECTUAL_ACTIVITY = 'intellectual_activity' : string
```


<a name="constant_PAYMENT" class="anchor"></a>
###### PAYMENT
```php
PAYMENT = 'payment' : string
```


<a name="constant_AGENT_COMMISSION" class="anchor"></a>
###### AGENT_COMMISSION
```php
AGENT_COMMISSION = 'agent_commission' : string
```


<a name="constant_PROPERTY_RIGHT" class="anchor"></a>
###### PROPERTY_RIGHT
```php
PROPERTY_RIGHT = 'property_right' : string
```


<a name="constant_NON_OPERATING_GAIN" class="anchor"></a>
###### NON_OPERATING_GAIN
```php
NON_OPERATING_GAIN = 'non_operating_gain' : string
```


<a name="constant_INSURANCE_PREMIUM" class="anchor"></a>
###### INSURANCE_PREMIUM
```php
INSURANCE_PREMIUM = 'insurance_premium' : string
```


<a name="constant_SALES_TAX" class="anchor"></a>
###### SALES_TAX
```php
SALES_TAX = 'sales_tax' : string
```


<a name="constant_RESORT_FEE" class="anchor"></a>
###### RESORT_FEE
```php
RESORT_FEE = 'resort_fee' : string
```


<a name="constant_COMPOSITE" class="anchor"></a>
###### COMPOSITE
```php
COMPOSITE = 'composite' : string
```


<a name="constant_ANOTHER" class="anchor"></a>
###### ANOTHER
```php
ANOTHER = 'another' : string
```


<a name="constant_FINE" class="anchor"></a>
###### FINE
```php
FINE = 'fine' : string
```


<a name="constant_TAX" class="anchor"></a>
###### TAX
```php
TAX = 'tax' : string
```


<a name="constant_LIEN" class="anchor"></a>
###### LIEN
```php
LIEN = 'lien' : string
```


<a name="constant_COST" class="anchor"></a>
###### COST
```php
COST = 'cost' : string
```


<a name="constant_PENSION_INSURANCE_WITHOUT_PAYOUTS" class="anchor"></a>
###### PENSION_INSURANCE_WITHOUT_PAYOUTS
```php
PENSION_INSURANCE_WITHOUT_PAYOUTS = 'pension_insurance_without_payouts' : string
```


<a name="constant_PENSION_INSURANCE_WITH_PAYOUTS" class="anchor"></a>
###### PENSION_INSURANCE_WITH_PAYOUTS
```php
PENSION_INSURANCE_WITH_PAYOUTS = 'pension_insurance_with_payouts' : string
```


<a name="constant_HEALTH_INSURANCE_WITHOUT_PAYOUTS" class="anchor"></a>
###### HEALTH_INSURANCE_WITHOUT_PAYOUTS
```php
HEALTH_INSURANCE_WITHOUT_PAYOUTS = 'health_insurance_without_payouts' : string
```


<a name="constant_HEALTH_INSURANCE_WITH_PAYOUTS" class="anchor"></a>
###### HEALTH_INSURANCE_WITH_PAYOUTS
```php
HEALTH_INSURANCE_WITH_PAYOUTS = 'health_insurance_with_payouts' : string
```


<a name="constant_HEALTH_INSURANCE" class="anchor"></a>
###### HEALTH_INSURANCE
```php
HEALTH_INSURANCE = 'health_insurance' : string
```


<a name="constant_CASINO" class="anchor"></a>
###### CASINO
```php
CASINO = 'casino' : string
```


<a name="constant_AGENT_WITHDRAWALS" class="anchor"></a>
###### AGENT_WITHDRAWALS
```php
AGENT_WITHDRAWALS = 'agent_withdrawals' : string
```


<a name="constant_NON_MARKED_EXCISE" class="anchor"></a>
###### NON_MARKED_EXCISE
```php
NON_MARKED_EXCISE = 'non_marked_excise' : string
```


<a name="constant_MARKED_EXCISE" class="anchor"></a>
###### MARKED_EXCISE
```php
MARKED_EXCISE = 'marked_excise' : string
```


<a name="constant_MARKED" class="anchor"></a>
###### MARKED
```php
MARKED = 'marked' : string
```


<a name="constant_NON_MARKED" class="anchor"></a>
###### NON_MARKED
```php
NON_MARKED = 'non_marked' : string
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