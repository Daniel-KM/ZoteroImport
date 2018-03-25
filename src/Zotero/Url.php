<?php
namespace ZoteroImport\Zotero;

class Url
{
    /**
     * Zotero API base URI.
     */
    const BASE = 'https://api.zotero.org';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $id;

    /**
     * Construct a Zotero URL.
     *
     * @param string $type The Zotero library type
     * @param int $id The Zotero library ID
     */
    public function __construct($type, $id)
    {
        switch ($type) {
            case 'user':
            case 'users':
                $type = 'users';
                break;
            case 'group':
            case 'groups':
                $type = 'groups';
                break;
            default:
                throw new \InvalidArgumentException('Invalid Zotero library type');
        }
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException('Invalid Zotero library ID');
        }
        $this->type = $type;
        $this->id = $id;
    }

    /**
     * Url of an item.
     *
     * @param string $zoteroItemKey
     * @return string
     */
    public function item($zoteroItemKey)
    {
        return sprintf('%s/%s/%s/items/%s', self::BASE, $this->type,
            $this->id, $zoteroItemKey);
    }

    /**
     * The set of all items in the library
     *
     * @param array $params
     * @return string
     */
    public function items(array $params = [])
    {
        return sprintf('%s/%s/%s/items%s', self::BASE, $this->type,
            $this->id, $this->getParams($params));
    }

    /**
     * The URL to an item file.
     *
     * @param string $itemKey
     * @param array $params
     * @return string
     */
    public function itemFile($itemKey, array $params = [])
    {
        return sprintf('%s/%s/%s/items/%s/file%s', self::BASE, $this->type,
            $this->id, $itemKey, $this->getParams($params));
    }

    /**
     * The set of all children of an item.
     *
     * The param "itemType" = "attachment" may be useful to get only files.
     *
     * @param string $itemKey
     * @param array $params
     * @return string
     */
    public function itemChildren($itemKey, array $params = [])
    {
        return sprintf('%s/%s/%s/items/%s/children%s', self::BASE, $this->type,
            $this->id, $itemKey, $this->getParams($params));
    }

    /**
     * The collection in the library (mainly to post items).
     *
     * @param string $collectionKey
     * @param array $params
     * @return string
     */
    public function collections(array $params = [])
    {
        return sprintf('%s/%s/%s/collections%s', self::BASE, $this->type,
            $this->id, $this->getParams($params));
    }

    /**
     * The set of items within a specific collection in the library
     *
     * @param string $collectionKey
     * @param array $params
     * @return string
     */
    public function collectionItems($collectionKey, array $params = [])
    {
        return sprintf('%s/%s/%s/collections/%s/items%s', self::BASE,
            $this->type, $this->id, $collectionKey, $this->getParams($params));
    }

    /**
     * The empty template for a Zotero item type.
     *
     * @param string $zoteroItemType
     * @param string $linkMode Needed for template "attachment."
     * @return array
     */
    public function template($itemType, $linkMode = null)
    {
        if ($itemType === 'attachment') {
            if (!in_array($linkMode, ['imported_file', 'imported_url', 'linked_file', 'linked_url'], true)) {
                $linkMode = 'imported_file';
            }
            $linkMode = '&linkMode=' . $linkMode;
        } else {
            $linkMode = '';
        }
        return sprintf('%s/items/new?itemType=%s%s', self::BASE, $itemType, $linkMode);
    }

    /**
     * The user id and privileges of the given API key.
     *
     * @param string $key
     * @return string
     */
    public static function key($key)
    {
        return sprintf('%s/keys/%s?v=3', self::BASE, $key);
    }

    /**
     * Build and return a URL query string
     *
     * @param array $params
     * @return string
     */
    public function getParams(array $params)
    {
        if (empty($params)) {
            return '';
        }
        return '?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    }
}
