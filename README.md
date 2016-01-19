# ArsenalPay Module for OpenCart CMS

*Arsenal Media LLC*

[Arsenal Pay processing center]( https://arsenalpay.ru/)



## Version
1.0.0

*Has been tested on OpenCart 1.5.x*

Basic feature list:

 * Allows seamlessly integrate unified payment frame into your site.
 * New payment method ArsenalPay will appear to pay for your products and services.
 * Allows to pay using mobile commerce and bank aquiring. More methods are about to become available. Please check for updates.
 * Supports two languages (Russian, English).
 
## How to install
1. Copy the contents of **upload** folder to your opencart installation keeping the folder structure.
2. Login to the Open Cart admin section and go to **Extensions > Payments**.
3. Find **Arsenal Pay** in the list of payment methods.
4. Click on **Install** and then on **Edit** to make payment module settings.

## Settings
 - Fill out **Unique token**, **Sign key** fields with your received token and key.
 - You can specify IP address only from which it will be allowed to receive callback requests about payments from ArsenalPay onto your site in **Allowed IP address** field.
 - Your online shop will be receiving callback requests about processed payments for automatically order status change. The callbacks will being received onto the address assigned in **Callback URL** field. Callback is set to address: `http(s)://yourSiteAddress/index.php?route=payment/arsenalpay/ap_callback`
 - If it is needed to add one more step to check a payer order number before payment processing you should fill out the field of **Check URL** in the module settings with url-address to which ArsenalPay will be sending requests with check parameters. By default the address is the same with **Callback URL**. 
 - Check **Frame address** to be as `https://arsenalpay.ru/payframe/pay.php` 
 - Choose **Payment type** as `card` to activate payments with bank cards or `mk` to activate payments from mobile phone accounts.
 - Set **Frame mode** as `1` to display payment frame inside your site, otherwise a payer will be redirected directly to the payment frame url. 
 - **Frame display parameters**. You can adjust **width**, **height**, **frameborder** and **scrolling** of ArsenalPay payment frame by setting iframe parameters. For instance, you can insert string in format: `width='100%' height='500' frameborder='0' scrolling='no'`. Go to html standard reference for more detailes about iframe parameters.
 - **css parameter**. You can specify CSS file to apply it to the view of payment frame by inserting css-file url.
 - Set order statuses for confirmed, canceled, failed and pending transactions.
 - You can enable/disable **Logs**.
 - Set **Status** as **Enabled**.
 - You can set **Geo Zone** where ArsenalPay payment method will be available.
 - Set **Sort Order**: the order number of ArsenalPay in the list of enabled payment methods.
 - Finally, save settings by clicking on **Save**.


## How to uninstall
1. Login to the Open Cart admin section and go to **Extensions > Payments**.
2. Find **Arsenal Pay** in the list of payment methods.
3. Click on **Unistall**.

## Usage
After successful installation and proper settings new choice of payment method with ArsenalPay will appear on your site. To make payment for an order a payer will need to:

1. Choose goods from the shop catalog.
2. Go into the order page.
3. Choose the ArsenalPay payment method.
4. Check the order detailes and confirm the order.
5. After filling out the information depending on the payment type he will receive SMS about payment confirmation or will be redirected to the page with the result of his payment.

------------------
### О МОДУЛЕ
* Модуль платежной системы ArsenalPay для OpenCart позволяет легко встроить платежную страницу на Ваш сайт.
* После установки модуля у Вас появится новый вариант оплаты товаров и услуг через платежную систему ArsenalPay.
* Платежная система ArsenalPay позволяет совершать оплату с различных источников списания средств: мобильных номеров (МТС/Мегафон/Билайн/TELE2), пластиковых карт (VISA/MasterCard/Maestro). Перечень доступных источников средств постоянно пополняется. Следите за обновлениями.
* Модуль поддерживает русский и английский языки.

### УСТАНОВКА
1. Скопируйте файлы из папки **upload** в корень Вашего сайта, сохраняя структуру вложенности папок;
2. Зайдите в администрирование OpenCart и пройдите к **Дополнения > Оплата**;
3. Найдите **Arsenal Pay** в списке методов оплат;
4. Нажмите на **Установить** и затем **Изменить**, чтобы провести настройки платежного модуля.

### НАСТРОЙКА
 - Заполните поля **Уникальный токен** и **Ключ**, присвоенными Вам токеном и ключом для подписи.
 - Вы можете задать IP-адрес, только с которого будут разрешены обратные запросы о совершаемых платежах, в поле **Разрешенный IP-адрес**.
 - Ваш интернет-магазин будет получать уведомления о совершенных платежах. На адрес, указанный в поле **URL для обратного запроса** на подтверждение платежа, от ArsenalPay будет поступать запрос с результатом платежа для фиксирования статусов заказа в системе предприятия. Обратный запрос настроен на адрес: `http(s)://адресВашегоСайта/index.php?route=payment/arsenalpay/ap_callback`
 - При необходимости добавления дополнительного шага с проверкой номера заказа перед проведением платежа, Вы должны заполнить поле **URL для обратного запроса** на проверку номера заказа, на который от ArsenalPay будет поступать запрос на проверку. По умолчанию значение совпадает с **Callback URL**.
 - Проверьте: **Адрес фрейма** должен быть установлен как `https://arsenalpay.ru/payframe/pay.php`
 - Установите **Тип оплаты** как `card` для активации платежей с пластиковых карт или  как `mk` — платежей с аккаунтов мобильных телефонов.
 - Вы можете устанавливать **Режим отображения фрейма**. Значение `1` соответствует отображению фрейма внутри Вашего сайта, иначе пользователь будет перенаправляться напрямую на адрес платежного фрейма.
 - **Параметры отображения iFrame**. Вы можете подгонять ширину, высоту, границу и прокрутку платежного фрейма, задавая соответствующие значения параметров iframe в формате `width='100%' height'500' frameborder='0' scrolling='no'`. За более подробной информацией о параметрах iframe обращайтесь к стандарту html.
 - Вы можете задать **Параметр css** для применения к отображению платежного фрейма, указав url css-файла.
 - Установите статусы заказов после подтверждения платежа, отказа от платежа, неудавшегося платежа и на время ожидания оплаты.
 - Вы можете включать/выключать **Логирование**.
 - Включите модуль, установив **Статус** на **Включено**.
 - Вы можете задать географическую зону, где будет доступен метод оплаты ArsenalPay.
 - Задайте **Порядок сортировки**: укажите порядковый номер ArsenalPay в списке включенных методов оплаты.
7. Закончив, сохраните настройки нажатием на **Сохранить**.

### УДАЛЕНИЕ
1. Зайдите в администрирование OpenCart и пройдите к **Доплнения > Оплата**;
2. Найдите **ArsenalPay** в списке методов оплаты;
2. Нажмите на **Удалить**.

### ИСПОЛЬЗОВАНИЕ
После успешной установки и настройки модуля на сайте появится возможность выбора платежной системы ArsenalPay.
Для оплаты заказа с помощью платежной системы ArsenalPay нужно:

1. Выбрать из каталога товар, который нужно купить.
2. Перейти на страницу оформления заказа (покупки).
3. В разделе "Платежные системы" выбрать платежную систему ArsenalPay.
4. Перейти на страницу подтверждения введенных данных и ввода источника списания средств (мобильный номер, пластиковая карта и т.д.).
5. После ввода данных об источнике платежа, в зависимости от его типа, либо придет СМС о подтверждении платежа, либо покупатель будет перенаправлен на страницу с результатом платежа.

------------------
### ОПИСАНИЕ РЕШЕНИЯ
ArsenalPay – удобный и надежный платежный сервис для бизнеса любого размера. 

Используя платежный модуль от ArsenalPay, вы сможете принимать онлайн-платежи от клиентов по всему миру с помощью: 
пластиковых карт международных платёжных систем Visa и MasterCard, эмитированных в любом банке
баланса мобильного телефона операторов МТС, Мегафон, Билайн, Ростелеком и ТЕЛЕ2
различных электронных кошельков 

### Преимущества сервиса: 
 - [Самые низкие тарифы](https://arsenalpay.ru/tariffs.html)
 - Бесплатное подключение и обслуживание
 - Легкая интеграция
 - [Агентская схема: ежемесячные выплаты разработчикам](https://arsenalpay.ru/partnership.html)
 - Вывод средств на расчетный счет без комиссии
 - Сервис смс оповещений
 - Персональный личный кабинет
 - Круглосуточная сервисная поддержка клиентов 

А ещё мы можем взять на техническую поддержку ваш сайт и создать для вас мобильные приложения для Android и iOS. 

ArsenalPay – увеличить прибыль просто! 
Мы работаем 7 дней в неделю и 24 часа в сутки. А вместе с нами множество российских и зарубежных компаний. 

### Как подключиться: 
1. Вы скачали модуль и установили его у себя на сайте;
2. Отправьте нам письмом ссылку на Ваш сайт на pay@arsenalpay.ru либо оставьте заявку на [сайте](https://arsenalpay.ru/#register) через кнопку "Подключиться";
3. Мы Вам вышлем коммерческие условия и технические настройки;
4. После Вашего согласия мы отправим Вам проект договора на рассмотрение.
5. Подписываем договор и приступаем к работе.

Всегда с радостью ждем ваших писем с предложениями. 

pay@arsenalpay.ru 

[arsenalpay.ru](https://arsenalpay.ru)
