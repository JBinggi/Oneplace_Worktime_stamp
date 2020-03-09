<?php
/**
 * StampTable.php - Stamp Table
 *
 * Table Model for Stamp Stamp
 *
 * @category Model
 * @package Worktime\Stamp
 * @author Verein onePlace
 * @copyright (C) 2020 Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace JBinggi\Worktime\Stamp\Model;

use Application\Controller\CoreController;
use Application\Model\CoreEntityTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter\DbSelect;

class StampTable extends CoreEntityTable {

    /**
     * StampTable constructor.
     *
     * @param TableGateway $tableGateway
     * @since 1.0.0
     */
    public function __construct(TableGateway $tableGateway) {
        parent::__construct($tableGateway);

        # Set Single Form Name
        $this->sSingleForm = 'worktimestamp-single';
    }

    /**
     * Get Stamp Entity
     *
     * @param int $id
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id) {
        # Use core function
        return $this->getSingleEntity($id,'Stamp_ID');
    }

    /**
     * Save Worktime Entity
     *
     * @param Stamp $oStamp
     * @return int Request ID
     * @since 1.0.0
     */
    public function saveSingle(Stamp $oStamp) {
        $aDefaultData = [
            'label' => $oStamp->label,
        ];

        return $this->saveSingleEntity($oStamp,'Stamp_ID',$aDefaultData);
    }

    /**
     * Generate new single Entity
     *
     * @return Stamp
     * @since 1.0.0
     */
    public function generateNew() {
        return new Stamp($this->oTableGateway->getAdapter());
    }
}