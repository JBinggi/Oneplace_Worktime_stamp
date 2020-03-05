<?php
/**
 * ApiController.php - Worktime Stamp Api Controller
 *
 * Main Controller for Worktime Stamp Api
 *
 * @category Controller
 * @package Worktime-Stamp
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace JBinggi\Worktime\Stamp\Controller;

use Application\Controller\CoreController;
use JBinggi\Worktime\Stamp\Model\StampTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;
use Zend\I18n\Translator\Translator;

class ApiController extends CoreController {
    /**
     * Worktime Table Object
     *
     * @since 1.0.0
     */
    private $oTableGateway;

    /**
     * ApiController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param StampTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,StampTable $oTableGateway,$oServiceManager) {
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'worktimestamp-single';
    }

    /**
     * API Main Controller
     *
     * @return ViewModel
     * @since 1.0.0
     */
    public function indexAction()
    {
        $this->layout('layout/layout-piview');

//        $aReturn = ['state'=>'error','message'=>'Type not found'];
//        echo json_encode($aReturn);
//        return false;
        return new ViewModel();
    }

    /**
     * API stamp worktime
     *
     * @return bool - no View File
     * @since 1.0.0
     */
    public function addAction() {
        $this->layout('layout/json');
        if(!key_exists('values',$_REQUEST))  {
            $aReturn = ['state'=>'error','message'=>'key value not found'];
            echo json_encode($aReturn);
            return false;

        }
        $sValues= json_decode($_REQUEST['values'], true);
        $sLabel= $sValues["label"];
        $sType= $sValues['type'];

        if($sType !=''){
            $oTag = CoreEntityController::$aCoreTables['core-entity-tag']->select(['entity_form_idfs'=>'worktimestamp-single','tag_value'=>$sType]);
            $iTagID = 0;
            if(count($oTag) > 0) {
                $iTagID = $oTag->current()->Entitytag_ID;
            } else {
                $aReturn = ['state'=>'error','message'=>'Type not found'];
                echo json_encode($aReturn);
                return false;
            }
        }

        $iFinger= $sValues['finger'];

        //TODO: Get Finger_idfs from worktime-stamp-finger

        $oStamp = $this->oTableGateway->generateNew();
        $oStamp->exchangeArray([
            'finger_idfs' => $iFinger,
            'type_idfs' => $iTagID
        ]);

        $this->oTableGateway->saveSingle($oStamp);

        $aReturn = ['state'=>'success','message'=>'Worktime Stamp'];
        $aJDReturn=json_encode($aReturn);
        echo $aJDReturn;
        return false;
    }
}
