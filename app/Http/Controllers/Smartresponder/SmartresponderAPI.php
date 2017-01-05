<?php

namespace larashop\Http\Controllers\Smartresponder;


class SmartresponderAPI
{
    public function getConfig()
    {
        return [
            'api_id' => '491608',
            'api_key' => 'asdADisi7GJnycvqgaouSysKZyExJRBj',
            'format' => 'json'
        ];
    }

    public function query($url, $action, $data = null, $id = null)
    {
        $dataMain = array_merge($this->getConfig(), $action);

        if ($data) {
            $data = array_merge($dataMain, $data);
        } elseif ($id) {
            $data = array_merge($dataMain, ['id' => $id]);
        } else {
            $data = $dataMain;
        }
        $content = http_build_query($data);
        echo $url . $content;
        $result = file_get_contents($url . $content);

        print_r(json_decode($result));

        return $result;
    }


    public function getAllStats()
    {
        $url = 'http://api.smartresponder.ru/stats.html?';
        $action = ['action' => 'list'];

        return $this->query($url, $action);
    }


    /*ОБЩИЕ ФУНКЦИИ*/
    public function getCountries()
    {
        $url = 'http://api.smartresponder.ru/deliveries.html?';
        $action = ['action' => 'list_countries'];

        return $this->query($url, $action);
    }
    /*КОНЕЦ ОБЩИХ ФУНКЦИЙ*/


    /* РАССЫЛКИ*/

    //получение списка рассылок (всех или по id)
    public function getAllDeliveries($id = null)
    {
        $url = 'http://api.smartresponder.ru/deliveries.html?';
        $action = ['action' => 'list'];

        return $this->query($url, $action, null, $id);
    }

    //удаление рассылки по id
    public function deleteDelivery($id)
    {
        $url = 'http://api.smartresponder.ru/deliveries.html?';
        $action = ['action' => 'delete'];

        return $this->query($url, $action, null, $id);
    }

    //создание рассылки (передаваемые парамерты по ссылке: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0202&file=/api/doc/deliveries.html)
    public function createDelivery($options)
    {
        $url = 'http://api.smartresponder.ru/deliveries.html?';
        $action = ['action' => 'create'];

        return $this->query($url, $action, $options);
    }

    //редактирование рассылки (передаваемые парамерты по ссылке: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0202&file=/api/doc/deliveries.html)
    public function editDelivery($options)
    {
        $url = 'http://api.smartresponder.ru/deliveries.html?';
        $action = ['action' => 'update'];

        return $this->query($url, $action, $options);
    }

    //изменение/добавление шаблона в серию писем (передаваемые парамерты по ссылке: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0202&file=/api/doc/deliveries.html)
    public function addTemplate($options)
    {
        $url = 'http://api.smartresponder.ru/deliveries.html?';
        $action = ['action' => 'add_template'];

        return $this->query($url, $action, $options);
    }


    /* КОНЕЦ РАССЫЛОК*/

    /* ШАБЛОНЫ ПИСЕМ*/

    //Получение списка шаблонов
    public function getTemplatesList()
    {
        $url = 'http://api.smartresponder.ru/templates.html?';
        $action = ['action' => 'list'];

        return $this->query($url, $action);
    }

    //создать шаблона (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0401&file=/api/doc/templates.html)
    public function createTemplate($options)
    {
        $url = 'http://api.smartresponder.ru/templates.html?';
        $action = ['action' => 'create'];

        return $this->query($url, $action, $options);
    }

    //обновить шаблон (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0401&file=/api/doc/templates.html)
    public function updateTemplate($options)
    {
        $url = 'http://api.smartresponder.ru/templates.html?';
        $action = ['action' => 'update'];

        return $this->query($url, $action, $options);
    }

    //удалить шаблон
    public function deleteTemplate($id)
    {
        $url = 'http://api.smartresponder.ru/templates.html?';
        $action = ['action' => 'delete'];

        return $this->query($url, $action, null, $id);
    }

    //прикрепить файл к шаблону

    //удалить файл из шаблона


    /* КОНЕЦ ШАБЛОНА ПИСЕМ*/


    /*ФАЙЛЫ*/

    /*КОНЕЦ ФАЙЛОВ*/


    /*УПРАВЛЕНИЕ СПИСКОМ ПОДПИСЧИКОВ*/

    //Получение списка подписчиков (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function getSubscribers($options)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'list'];

        return $this->query($url, $action, $options);
    }

    //Добавление подписчика (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function addSubscriber($options)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'create'];

        return $this->query($url, $action, $options);
    }

    //Добавление подписчика (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function editSubscriber($options)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'update'];

        return $this->query($url, $action, $options);
    }

    //Удаление подписчика из списка автора
    public function deleteSubscriber($id)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'delete'];

        return $this->query($url, $action, null, $id);
    }

    //Включение подписчика в список рассылки
    public function linkWithDelivery($options)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'link_with_delivery'];

        return $this->query($url, $action, $options);
    }

    //Включение подписчика в список канала (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function linkWithTrack($options)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'link_with_track'];

        return $this->query($url, $action, $options);
    }

    //Включение подписчика в список группы (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function linkWithGroup($options)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'link_with_group'];

        return $this->query($url, $action, $options);
    }

    //Исключение подписчика в список рассылки
    public function unlinkWithDelivery($options)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'unlink_with_delivery'];

        return $this->query($url, $action, $options);
    }

    //Исключение подписчика в список канала (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function unlinkWithTrack($options)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'unlink_with_track '];

        return $this->query($url, $action, $options);
    }

    //Исключение подписчика в список группы (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function unlinkWithGroup($options)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'unlink_with_group'];

        return $this->query($url, $action, $options);
    }

    //Проверка вхождения email-адреса в список автора (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function checkEmail($options)
    {
        $url = 'http://api.smartresponder.ru/subscribers.html?';
        $action = ['action' => 'check_email'];

        return $this->query($url, $action, $options);
    }

    /*КОНЕЦ УПРАВЛЕНИЯ СПИСКОМ ПОДПИСЧИКОВ*/

    /*ПОДПИСКА НА РАССЫЛКУ*/

    //Подписка на рассылку (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function onDelivery($options)
    {
        $url = 'http://api.smartresponder.ru/subscribe.html?';
        $action = ['action' => 'on_delivery'];

        return $this->query($url, $action, $options);
    }

    //Подписка на ранее сохраненный шаблон письма (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function onTemplate($options)
    {
        $url = 'http://api.smartresponder.ru/subscribe.html?';
        $action = ['action' => 'on_template'];

        return $this->query($url, $action, $options);
    }

    //Подписка на произвольное сообщение (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S0501&file=/api/doc/subscribers.html)
    public function onMessage($options)
    {
        $url = 'http://api.smartresponder.ru/subscribe.html?';
        $action = ['action' => 'on_message'];

        return $this->query($url, $action, $options);
    }

    /*КОНЕЦ ПОДПИСКИ НА РАССЫЛКУ*/

    /*УПРАВЛЕНИЕ АККАУНТОМ АВТОРА*/
    public function getAuthor()
    {
        $url = 'http://api.smartresponder.ru/account.html?';
        $action = ['action' => 'info '];

        return $this->query($url, $action);
    }
    /*КОНЕЦ УПРАВЛЕНИЯ АККАУНТОМ АВТОРА*/


    /*УПРАВЛЕНИЕ СТАТИСТИКОЙ*/

    //Получение списка статистики по рассылкам (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S1101&file=/api/doc/stats.html )
    public function getDeliveryStats($options)
    {
        $url = 'http://api.smartresponder.ru/stats.html?';
        $action = ['action' => 'list'];

        return $this->query($url, $action, $options);
    }

    //Получение списка открытий письма (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S1101&file=/api/doc/stats.html )
    public function getMessagesStats($options)
    {
        $url = 'http://api.smartresponder.ru/stats.html?';
        $action = ['action' => 'list_openings'];

        return $this->query($url, $action, $options);
    }

    //Получение списка переходов по ссылкам письма (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S1101&file=/api/doc/stats.html )
    public function getListClicks($options)
    {
        $url = 'http://api.smartresponder.ru/stats.html?';
        $action = ['action' => 'list_clicks'];

        return $this->query($url, $action, $options);
    }

    //Получение списка подписчиков, нажавших на спам (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S1101&file=/api/doc/stats.html )
    public function getSpamClicks($options)
    {
        $url = 'http://api.smartresponder.ru/stats.html?';
        $action = ['action' => 'list_spam'];

        return $this->query($url, $action, $options);
    }

    //Получение списка подписчиков, нажавших на спам (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S1101&file=/api/doc/stats.html )
    public function getLastClick($options)
    {
        $url = 'http://api.smartresponder.ru/stats.html?';
        $action = ['action' => 'last_click'];

        return $this->query($url, $action, $options);
    }

    //Получение последнего перехода в письме (параметры искать здесь: https://smartresponder.ru/l_ru/api.html#?href=api.html?phase=_retrieve&anchor_id=S1101&file=/api/doc/stats.html )
    public function getLastOpening($options)
    {
        $url = 'http://api.smartresponder.ru/stats.html?';
        $action = ['action' => 'last_opening'];

        return $this->query($url, $action, $options);
    }


    /*КОНЕЦ УПРАВЛЕНИЯ СТАТИСТИКОЙ*/
}
