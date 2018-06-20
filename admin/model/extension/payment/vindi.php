<?php

class ModelExtensionPaymentVindi extends Model
{
    private $api_version = 'v1';
    private $extension_version = '1.0.0';


    public function getPartnerSolutionId()
    {
        return 'OPENCART_' . VERSION . '_ISENSE_' . $this->extension_version;
    }

    public function createTables()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "vindi_transaction` (
         `vindi_transaction_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
         `transaction_id` char(40) NOT NULL,
         `merchant` char(16) NOT NULL,
         `order_id` int(11) NOT NULL,
         `partnerSolutionId` char(40) NOT NULL,
         `response_gatewayCode` char(15) NOT NULL,
         `result` char(7) NOT NULL,
         `transaction_type` char(20) NOT NULL,
         `transaction_amount` decimal(15,2) NOT NULL,
         `transaction_currency` char(3) NOT NULL,
         `billing_address_city` char(100) NOT NULL,
         `billing_address_company` char(100) NOT NULL,
         `billing_address_country` char(3) NOT NULL,
         `billing_address_postcodeZip` char(10) NOT NULL,
         `billing_address_stateProvince` char(20) NOT NULL,
         `billing_address_street` char(100) NOT NULL,
         `risk_response_gatewayCode` char(15) NOT NULL,
         `risk_response_totalScore` int(11) NOT NULL,
         `version` char(8) NOT NULL,
         `device_browser` char(255) NOT NULL,
         `device_ipAddress` char(15) NOT NULL,
         `timeOfRecord` char(29) NOT NULL,
         `notification_date` datetime NOT NULL,
         PRIMARY KEY (`vindi_transaction_id`),
         KEY `transaction_id_order_id` (`transaction_id`,`order_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "vindi_token` (
         `vindi_token_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
         `customer_id` int(11) NOT NULL,
         `token` char(40) NOT NULL,
         `date_added` datetime NOT NULL,
         PRIMARY KEY (`vindi_token_id`),
         KEY `customer_id` (`customer_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    public function dropTables()
    {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "vindi_transaction`");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "vindi_token`");
    }

    public function hookEvents()
    {
        $events = [
            'catalog/controller/checkout/checkout/before' => 'extension/payment/vindi/init',
        ];

        $this->load->model('setting/event');

        foreach ($events as $trigger => $action) {
            $this->model_setting_event->addEvent('payment_vindi', $trigger, $action, 1, 0);
        }
    }


    public function unhookEvents()
    {
        $this->load->model('setting/event');

        $this->model_setting_event->deleteEventByCode('payment_vindi');
    }

    public function getTotalTransactions($data)
    {
        $sql = "SELECT COUNT(*) as total FROM `" . DB_PREFIX . "vindi_transaction`";

        if (!empty($data['transaction_id']) || !empty($data['order_id'])) {
            $sql .= " WHERE";

            $where = [];

            if (!empty($data['transaction_id'])) {
                $where[] = "transaction_id='" . $this->db->escape($data['transaction_id']) . "'";
            }

            if (!empty($data['order_id'])) {
                $where[] = "order_id='" . (int)$data['order_id'] . "'";
            }

            $sql .= " " . implode(" AND ", $where);
        }

        $total_query = $this->db->query($sql);

        return $total_query->row['total'];
    }

    public function deleteTokens($customer_id)
    {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "vindi_token` WHERE customer_id='" . (int)$customer_id . "'");
    }

    public function getTransactions($data)
    {
        $sql = "SELECT * FROM `" . DB_PREFIX . "vindi_transaction`";

        if (!empty($data['transaction_id']) || !empty($data['order_id'])) {
            $sql .= " WHERE";

            $where = [];

            if (!empty($data['transaction_id'])) {
                $where[] = "transaction_id='" . $this->db->escape($data['transaction_id']) . "'";
            }

            if (!empty($data['order_id'])) {
                $where[] = "order_id='" . (int)$data['order_id'] . "'";
            }

            $sql .= " " . implode(" AND ", $where);
        }

        $sql .= " ORDER BY timeOfRecord DESC";

        if (isset($data['start']) && isset($data['limit'])) {
            $sql .= " LIMIT " . $data['start'] . ', ' . $data['limit'];
        }

        return $this->db->query($sql)->rows;
    }

    public function getTransaction($vindi_transaction_id)
    {
        return $this->db->query("SELECT * FROM `" . DB_PREFIX . "vindi_transaction` WHERE vindi_transaction_id='" . (int)$vindi_transaction_id . "'")->row;
    }

    public function findTransactionId($order_id)
    {
        $response = $this->api('order/' . $order_id, [], 'GET');

        if (!empty($response['result']) && $response['result'] == 'SUCCESS' && !empty($response['transaction'])) {
            $max = 0;

            foreach ($response['transaction'] as $transaction) {
                if ((int)$transaction['transaction']['id'] > $max) {
                    $max = (int)$transaction['transaction']['id'];
                }
            }

            return $max + 1;
        }

        return 0;
    }

    public function api($api_method, $data = [], $method = 'GET')
    {
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
        $this->load->language('extension/payment/vindi');
        $gateway = $this->getGateway() . '/api/' . $this->getApiVersion();
        $url = $gateway . $this->config->get('payment_vindi_merchant') . '/' . $api_method;
        $curl_options = [
            CURLOPT_URL => $url,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->config->get('payment_vindi_api_key') . ':',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'User-Agent: '. trim('OpenCart/' . $this->extension_version . "; {$host}"),
            ],
            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
        ];

        $put_fd = null;

        if ($method == 'POST') {
            $curl_options[CURLOPT_POST] = true;
            $curl_options[CURLOPT_POSTFIELDS] = json_encode($data);
        } else {
            if ($method == 'PUT') {
                $curl_options[CURLOPT_PUT] = true;

                $write_data = json_encode($data);

                $put_fd = tmpfile();
                fwrite($put_fd, $write_data);
                fseek($put_fd, 0);

                $curl_options[CURLOPT_INFILE] = $put_fd;
                $curl_options[CURLOPT_INFILESIZE] = strlen($write_data);
            }
        }

        $curl = curl_init();
        curl_setopt_array($curl, $curl_options);
        $output = curl_exec($curl);
        curl_close($curl);
        if ($this->config->get('payment_vindi_debug_log')) {
            $text = PHP_EOL . sprintf($this->language->get('text_log_api_intro'), 'REQUEST') . PHP_EOL;
            $text .= var_export($curl_options, true) . PHP_EOL;
            $text .= sprintf($this->language->get('text_log_api_intro'), 'DATA') . PHP_EOL;
            $text .= json_encode($data) . PHP_EOL;
            $text .= sprintf($this->language->get('text_log_api_intro'), 'RESPONSE') . PHP_EOL;
            $text .= var_export($output, true) . PHP_EOL;
            $text .= "==================================" . PHP_EOL;

            $this->log->write($text);
        }

        if (is_resource($put_fd)) {
            fclose($put_fd);
        }

        return json_decode($output, true);
    }

    public function getGateway()
    {
        return 'https://' . $this->config->get('payment_vindi_gateway') . '.vindi.com.br';
    }


    public function getApiVersion()
    {
        return $this->api_version;
    }

    public function addProduct()
    {
        $this->api('products/', [
            'name' => 'OpenCart Produto Tax',
            'code' => 'opencart_product_tax',
            'status' => 'active',
            'pricing_schema' => ['price' => 0],
        ], 'POST');

        $this->api('products/', [
            'name' => 'OpenCart Frete',
            'code' => 'opencart_shipping',
            'status' => 'active',
            'pricing_schema' => ['price' => 0],
        ], 'POST');

    }

}