<?php
/**
 * StampController.php - Main Controller
 *
 * Main Controller for Stamp Stamp Plugin
 *
 * @category Controller
 * @package Worktime\Stamp
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace JBinggi\Worktime\Stamp\Controller;

use Application\Controller\CoreEntityController;
use Application\Model\CoreEntityModel;
use JBinggi\Worktime\Stamp\Model\StampTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class StampController extends CoreEntityController {
    /**
     * Stamp Table Object
     *
     * @since 1.0.0
     */
    protected $oTableGateway;

    /**
     * StampController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param StampTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,StampTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'worktimestamp-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    # Custom Code here:

}
