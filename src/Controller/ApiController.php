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
     * API Home - Main Index
     *
     * @return bool - no View File
     * @since 1.0.0
     */
    public function indexAction() {
        $this->layout('layout/json');
        $sLabel = '';
        $sType = '';
//	    var_dump($_REQUEST);

//        $aReturn = ['state'=>'success','message'=>'sett wortime'];
//        var_dump($_REQUEST);
//        return false;


        $sValues= json_decode($_REQUEST['values'], true);

        //return;

        $sLabel= $sValues["label"];
//	    var_dump($sLabel);
        $sType= $sValues['type'];
//	    var_dump($sType);
        if($sType !=''){
            $oTag = CoreEntityController::$aCoreTables['core-entity-tag']->select(['entity_form_idfs'=>'worktimestamp-single','tag_value'=>$sType]);
            //var_dump($oTag);
            $iTagID = 0;
            if(count($oTag) > 0) {
                $iTagID = $oTag->current()->Entitytag_ID;
//		    var_dump($iTagID);
            } else {
                $aReturn = ['state'=>'error','message'=>'Type not found'];
                echo json_encode($aReturn);
                return false;
            }
        }

        $iFinger= $sValues['finger'];
//	    var_dump($iFinger);
        //TODO: Get Finger_idfs from worktime-stamp-finger



        $oStamp = $this->oTableGateway->generateNew();
        $oStamp->exchangeArray([
//            'label' => $sLabel,
            'finger_idfs' => $iFinger,
            'type_idfs' => $iTagID
        ]);
//        var_dump($oStamp);

        $this->oTableGateway->saveSingle($oStamp);

        $aReturn = ['state'=>'success','message'=>'set wortime'];
//        echo json_encode($aReturn);
        $aJDReturn=json_encode($aReturn);
//        var_dump($aReturn);
//        var_dump($aJDReturn);
        echo $aJDReturn;
        return false;
    }
}
