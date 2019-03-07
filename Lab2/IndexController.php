 <?php
/**
 * Created by PhpStorm.
 * User: z_kurtev
 * Date: 2019-02-06
 * Time: 7:47 PM
 */

require 'TemplateManager.php';
require 'DataStore.php';

class IndexController
{
    protected $data = [];
    protected $viewManager;

    public function indexActions()
    {
        $dataStore = new DataStore();

        $this->data['firstName'] = $dataStore->getFirstName();
        $this->data['lastName'] = $dataStore->getLastName();
        $this->data['age'] = $dataStore->getAge();

        $this->viewManager = new TemplateManager();
        $this->viewManager->setData($this->data);
        $this->viewManager->loadTemplate();
        $this->viewManager->render();


    }
}