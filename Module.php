<?php
namespace ZoteroImport;

use Omeka\Module\AbstractModule;
use Zend\EventManager\Event;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function install(ServiceLocatorInterface $services)
    {
        $conn = $services->get('Omeka\Connection');
        $conn->exec('SET FOREIGN_KEY_CHECKS=0;');
        $conn->exec('CREATE TABLE zotero_import (id INT AUTO_INCREMENT NOT NULL, job_id INT DEFAULT NULL, undo_job_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, version INT NOT NULL, UNIQUE INDEX UNIQ_82A3EEB8BE04EA9 (job_id), UNIQUE INDEX UNIQ_82A3EEB84C276F75 (undo_job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;');
        $conn->exec('CREATE TABLE zotero_import_item (id INT AUTO_INCREMENT NOT NULL, import_id INT NOT NULL, item_id INT NOT NULL, zotero_key VARCHAR(255) NOT NULL, INDEX IDX_86A2392BB6A263D9 (import_id), INDEX IDX_86A2392B126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;');
        $conn->exec('ALTER TABLE zotero_import ADD CONSTRAINT FK_82A3EEB8BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE;');
        $conn->exec('ALTER TABLE zotero_import ADD CONSTRAINT FK_82A3EEB84C276F75 FOREIGN KEY (undo_job_id) REFERENCES job (id) ON DELETE CASCADE;');
        $conn->exec('ALTER TABLE zotero_import_item ADD CONSTRAINT FK_86A2392BB6A263D9 FOREIGN KEY (import_id) REFERENCES zotero_import (id) ON DELETE CASCADE;');
        $conn->exec('ALTER TABLE zotero_import_item ADD CONSTRAINT FK_86A2392B126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE;');
        $conn->exec('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function uninstall(ServiceLocatorInterface $services)
    {
        $conn = $services->get('Omeka\Connection');
        $conn->exec('SET FOREIGN_KEY_CHECKS=0;');
        $conn->exec('DROP TABLE zotero_import;');
        $conn->exec('DROP TABLE zotero_import_item;');
        $conn->exec('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach(
            \Omeka\Api\Adapter\ItemAdapter::class,
            'api.search.query',
            [$this, 'apiSearchQuery']
        );

        $sharedEventManager->attach(
            'Omeka\Controller\Admin\ItemSet',
            'view.layout',
            [$this, 'adminViewLayout']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.layout',
            [$this, 'adminViewLayout']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\ItemSet',
            'view.show.sidebar',
            [$this, 'adminViewShowSidebar']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.show.sidebar',
            [$this, 'adminViewShowSidebar']
        );
    }

    public function apiSearchQuery(Event $event)
    {
        $query = $event->getParam('request')->getContent();
        if (isset($query['zotero_import_id'])) {
            $qb = $event->getParam('queryBuilder');
            $adapter = $event->getTarget();
            $itemAlias = \Omeka\Module::VERSION < 2 ? $adapter->getEntityClass() : 'omeka_root';
            $importItemAlias = $adapter->createAlias();
            $qb
                ->innerJoin(
                    \ZoteroImport\Entity\ZoteroImportItem::class, $importItemAlias,
                    'WITH', "$importItemAlias.item = $itemAlias.id"
                )
                ->andWhere($qb->expr()->eq(
                    "$importItemAlias.import",
                    $adapter->createNamedParameter($qb, $query['zotero_import_id'])
                )
            );
        }
    }

    public function adminViewLayout(Event $event)
    {
        $view = $event->getTarget();
        $view->headScript()
            ->appendFile($view->assetUrl('js/zotero-import.js', 'ZoteroImport'), 'text/javascript', ['defer' => 'defer']);
    }

    public function adminViewShowSidebar(Event $event)
    {
        $view = $event->getTarget();
        $resource = $view->resource;
        $query = [];
        $query['resource_type'] = $resource->resourceName();
        $query['resource_ids'] = [$resource->id()];
        $link = $view->hyperlink(
            $view->translate('Export to Zotero'), // @translate
            $view->url('admin/zotero/default', ['action' => 'export'], ['query' => $query])
        );
        echo '<div class="meta-group">'
            . '<h4>Zotero</h4>'
            . '<div class="value">' . $link . '</div>'
            . '</div>';
    }
}
