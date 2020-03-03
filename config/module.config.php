<?php
/**
 * module.config.php - Stamp Config
 *
 * Main Config File for Stamp Stamp Plugin
 *
 * @category Config
 * @package Worktime\Stamp
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace JBinggi\Worktime\Stamp;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    # Stamp Module - Routes
    'router' => [
        'routes' => [
            'worktime-stamp' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/worktime/stamp[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\StampController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'worktime-stamp-setup' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/worktime/stamp/setup',
                    'defaults' => [
                        'controller' => Controller\InstallController::class,
                        'action'     => 'checkdb',
                    ],
                ],
            ],
        ],
    ], # Routes

    # View Settings
    'view_manager' => [
        'template_path_stack' => [
            'worktime-stamp' => __DIR__ . '/../view',
        ],
    ],
];