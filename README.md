# **Fiqon**

Fiqon defines classes to help developers to consume **Fiqon**'s services. It can be simply added using composer. 
```bash
composer require "fiqon/fiqon"
```

## Transmission static class
It holds global values just pass null value to other classes to use the value from transmission or pass a value to overwrite it.

```php
Fiqon\Transmission::setIdentifier("identifier");
new Event();
```

```php
new Event(transmission: "identifier");
```

```php
$evt = new Event();
$evt->setTransmissionIdentifier("identifier");
```
The codes has te same result, but the first uses globlas as value and the others change only the current event.

## Event class
Manages every thing a event needs to work and sends to **fiqon**'s api to be processed.
```php
$evt = new Event();
$response = $evt->sendRequest();
```
Events are processed in background, so you will receive only a accepted message and a token to check event status. Otherwise it will return an error and abort your request.

## Immediate
Just like event, but it waits for the event to finish processing and get the response.
```php
$immediate = new Immediate();
$response = $immediate->sendRequest();
```

## Webhook
Webhook calls webhook for an especific transmission, it requires a identifier and a token.
```php
$webhook = new Webhook();
$reponse = $webhook->sendRequest();
```
Get accepted as response, if it is everything ok and process the request on background