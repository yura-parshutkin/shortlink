<?php

namespace App\Repository;

use App\Model\Entity\Link;
use App\Model\Repository\LinkRepository;
use App\ValueObject\Url;

class LinkPostgresRepository implements LinkRepository
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param Link $link
     */
    public function add(Link $link)
    {
        $sql   = '
            INSERT INTO links(id, url, short_id) 
            VALUES(:id, :url, :short_id)
        ';

        $query = $this->db->prepare($sql);
        $query->execute([
            'id'       => $link->getId(),
            'url'      => (string)$link->getUrl(),
            'short_id' => $link->getShortId()
        ]);
    }

    /**
     * @param Url $url
     * @return Link|null
     */
    public function findOneByUrl(Url $url) : ?Link
    {
        $sql = '
            SELECT l.id, l.url, l.short_id
            FROM links l
            WHERE l.url = :url
        ';

        return $this->findOneByQuery($sql, [
            'url' => $url
        ]);
    }

    /**
     * @param string $shortId
     * @return Link|null
     */
    public function findOneByShortId(string $shortId) : ?Link
    {
        $sql = '
            SELECT l.id, l.url, l.short_id
            FROM links l
            WHERE l.short_id = :short_id
        ';

        return $this->findOneByQuery($sql, [
            'short_id' => $shortId
        ]);
    }

    /**
     * @param array $link
     * @return Link
     */
    protected function createLink(array $link)
    {
        return new Link(
            $link['id'],
            Url::fromString($link['url']),
            $link['short_id']
        );
    }

    /**
     * @param string $sql
     * @param array $params
     * @return Link|null
     */
    protected function findOneByQuery(string $sql, array $params = [])
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);

        if (!$link = $query->fetch()) {
            return null;
        }

        return $this->createLink($link);
    }
}