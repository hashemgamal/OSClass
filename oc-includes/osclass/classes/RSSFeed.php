<?php

/*
 *      OSCLass – software for creating and publishing online classified
 *                           advertising platforms
 *
 *                        Copyright (C) 2010 OSCLASS
 *
 *       This program is free software: you can redistribute it and/or
 *     modify it under the terms of the GNU Affero General Public License
 *     as published by the Free Software Foundation, either version 3 of
 *            the License, or (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful, but
 *         WITHOUT ANY WARRANTY; without even the implied warranty of
 *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *             GNU Affero General Public License for more details.
 *
 *      You should have received a copy of the GNU Affero General Public
 * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * This class takes items descriptions and generates a RSS feed from that information.
 * @author OSClass
 */
class RSSFeed {
    private $title;
    private $link;
    private $description;
    private $items;

    public function __construct() {
        $this->items = array();
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function addItem($item) {
        $this->items[] = $item;
    }

    public function dumpXML() {
        echo '<?xml version="1.0" encoding="UTF-8"?>', PHP_EOL;
        echo '<rss version="2.0">', PHP_EOL;
        echo '<channel>', PHP_EOL;
        echo '<title>', $this->title, '</title>', PHP_EOL;
        echo '<link>', $this->link, '</link>', PHP_EOL;
        echo '<description>', $this->description, '</description>', PHP_EOL;
        foreach ($this->items as $item) {
            echo '<item>', PHP_EOL;
            echo '<title>', $item['title'], '</title>', PHP_EOL;
            echo '<link>', $item['link'], '</link>', PHP_EOL;
            echo '<description>', $item['description'], '</description>', PHP_EOL;
            echo '</item>', PHP_EOL;
        }
        echo '</channel>', PHP_EOL;
        echo '</rss>', PHP_EOL;
    }
}

