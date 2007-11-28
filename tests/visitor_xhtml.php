<?php
/**
 * @copyright Copyright (C) 2005-2007 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 * @version //autogentag//
 * @filesource
 * @package Tree
 * @subpackage Tests
 */

require_once 'tree.php';

/**
 * @package Tree
 * @subpackage Tests
 */
class ezcTreeVisitorXHTMLTest extends ezcTreeVisitorTest
{
    public function testVisitorXHTMLDefault()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorXHTML();
        $tree->accept( $visitor );
        $expected = <<<END
  <ul>
    <li><a href="/Hylobatidae">Hylobatidae</a>
      <ul>
        <li><a href="/Hylobatidae/Hylobates">Hylobates</a>
          <ul>
            <li><a href="/Hylobatidae/Hylobates/Lar Gibbon">Lar Gibbon</a></li>
            <li><a href="/Hylobatidae/Hylobates/Agile Gibbon">Agile Gibbon</a></li>
            <li><a href="/Hylobatidae/Hylobates/Müller's Bornean Gibbon">Müller's Bornean Gibbon</a></li>
            <li><a href="/Hylobatidae/Hylobates/Silvery Gibbon">Silvery Gibbon</a></li>
            <li><a href="/Hylobatidae/Hylobates/Pileated Gibbon">Pileated Gibbon</a></li>
            <li><a href="/Hylobatidae/Hylobates/Kloss's Gibbon">Kloss's Gibbon</a></li>
          </ul>
        </li>
        <li><a href="/Hylobatidae/Hoolock">Hoolock</a>
          <ul>
            <li><a href="/Hylobatidae/Hoolock/Western Hoolock Gibbon">Western Hoolock Gibbon</a></li>
            <li><a href="/Hylobatidae/Hoolock/Eastern Hoolock Gibbon">Eastern Hoolock Gibbon</a></li>
          </ul>
        </li>
        <li><a href="/Hylobatidae/Symphalangus">Symphalangus</a></li>
        <li><a href="/Hylobatidae/Nomascus">Nomascus</a>
          <ul>
            <li><a href="/Hylobatidae/Nomascus/Black Crested Gibbon">Black Crested Gibbon</a></li>
            <li><a href="/Hylobatidae/Nomascus/Eastern Black Crested Gibbon">Eastern Black Crested Gibbon</a></li>
            <li><a href="/Hylobatidae/Nomascus/White-cheecked Crested Gibbon">White-cheecked Crested Gibbon</a></li>
            <li><a href="/Hylobatidae/Nomascus/Yellow-cheecked Gibbon">Yellow-cheecked Gibbon</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="/Hominidae">Hominidae</a>
      <ul>
        <li><a href="/Hominidae/Pongo">Pongo</a>
          <ul>
            <li><a href="/Hominidae/Pongo/Bornean Orangutan">Bornean Orangutan</a></li>
            <li><a href="/Hominidae/Pongo/Sumatran Orangutan">Sumatran Orangutan</a></li>
          </ul>
        </li>
        <li><a href="/Hominidae/Gorilla">Gorilla</a>
          <ul>
            <li><a href="/Hominidae/Gorilla/Western Gorilla">Western Gorilla</a>
              <ul>
                <li><a href="/Hominidae/Gorilla/Western Gorilla/Western Lowland Gorilla">Western Lowland Gorilla</a></li>
                <li><a href="/Hominidae/Gorilla/Western Gorilla/Cross River Gorilla">Cross River Gorilla</a></li>
              </ul>
            </li>
            <li><a href="/Hominidae/Gorilla/Eastern Gorilla">Eastern Gorilla</a>
              <ul>
                <li><a href="/Hominidae/Gorilla/Eastern Gorilla/Mountain Gorilla">Mountain Gorilla</a></li>
                <li><a href="/Hominidae/Gorilla/Eastern Gorilla/Eastern Lowland Gorilla">Eastern Lowland Gorilla</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="/Hominidae/Homo">Homo</a>
          <ul>
            <li><a href="/Hominidae/Homo/Homo Sapiens">Homo Sapiens</a>
              <ul>
                <li><a href="/Hominidae/Homo/Homo Sapiens/Homo Sapiens Sapiens">Homo Sapiens Sapiens</a></li>
                <li><a href="/Hominidae/Homo/Homo Sapiens/Homo Superior">Homo Superior</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="/Hominidae/Pan">Pan</a>
          <ul>
            <li><a href="/Hominidae/Pan/Common Chimpanzee">Common Chimpanzee</a></li>
            <li><a href="/Hominidae/Pan/Bonobo">Bonobo</a></li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>

END;
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorXHTMLDisplayRootNode()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorXHTML();
        $visitor->options->displayRootNode = true;

        $tree->accept( $visitor );
        $expected = <<<END
<ul>
<li>Hominoidea</li>
  <ul>
    <li><a href="/Hominoidea/Hylobatidae">Hylobatidae</a>
      <ul>
        <li><a href="/Hominoidea/Hylobatidae/Hylobates">Hylobates</a>
          <ul>
            <li><a href="/Hominoidea/Hylobatidae/Hylobates/Lar Gibbon">Lar Gibbon</a></li>
            <li><a href="/Hominoidea/Hylobatidae/Hylobates/Agile Gibbon">Agile Gibbon</a></li>
            <li><a href="/Hominoidea/Hylobatidae/Hylobates/Müller's Bornean Gibbon">Müller's Bornean Gibbon</a></li>
            <li><a href="/Hominoidea/Hylobatidae/Hylobates/Silvery Gibbon">Silvery Gibbon</a></li>
            <li><a href="/Hominoidea/Hylobatidae/Hylobates/Pileated Gibbon">Pileated Gibbon</a></li>
            <li><a href="/Hominoidea/Hylobatidae/Hylobates/Kloss's Gibbon">Kloss's Gibbon</a></li>
          </ul>
        </li>
        <li><a href="/Hominoidea/Hylobatidae/Hoolock">Hoolock</a>
          <ul>
            <li><a href="/Hominoidea/Hylobatidae/Hoolock/Western Hoolock Gibbon">Western Hoolock Gibbon</a></li>
            <li><a href="/Hominoidea/Hylobatidae/Hoolock/Eastern Hoolock Gibbon">Eastern Hoolock Gibbon</a></li>
          </ul>
        </li>
        <li><a href="/Hominoidea/Hylobatidae/Symphalangus">Symphalangus</a></li>
        <li><a href="/Hominoidea/Hylobatidae/Nomascus">Nomascus</a>
          <ul>
            <li><a href="/Hominoidea/Hylobatidae/Nomascus/Black Crested Gibbon">Black Crested Gibbon</a></li>
            <li><a href="/Hominoidea/Hylobatidae/Nomascus/Eastern Black Crested Gibbon">Eastern Black Crested Gibbon</a></li>
            <li><a href="/Hominoidea/Hylobatidae/Nomascus/White-cheecked Crested Gibbon">White-cheecked Crested Gibbon</a></li>
            <li><a href="/Hominoidea/Hylobatidae/Nomascus/Yellow-cheecked Gibbon">Yellow-cheecked Gibbon</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="/Hominoidea/Hominidae">Hominidae</a>
      <ul>
        <li><a href="/Hominoidea/Hominidae/Pongo">Pongo</a>
          <ul>
            <li><a href="/Hominoidea/Hominidae/Pongo/Bornean Orangutan">Bornean Orangutan</a></li>
            <li><a href="/Hominoidea/Hominidae/Pongo/Sumatran Orangutan">Sumatran Orangutan</a></li>
          </ul>
        </li>
        <li><a href="/Hominoidea/Hominidae/Gorilla">Gorilla</a>
          <ul>
            <li><a href="/Hominoidea/Hominidae/Gorilla/Western Gorilla">Western Gorilla</a>
              <ul>
                <li><a href="/Hominoidea/Hominidae/Gorilla/Western Gorilla/Western Lowland Gorilla">Western Lowland Gorilla</a></li>
                <li><a href="/Hominoidea/Hominidae/Gorilla/Western Gorilla/Cross River Gorilla">Cross River Gorilla</a></li>
              </ul>
            </li>
            <li><a href="/Hominoidea/Hominidae/Gorilla/Eastern Gorilla">Eastern Gorilla</a>
              <ul>
                <li><a href="/Hominoidea/Hominidae/Gorilla/Eastern Gorilla/Mountain Gorilla">Mountain Gorilla</a></li>
                <li><a href="/Hominoidea/Hominidae/Gorilla/Eastern Gorilla/Eastern Lowland Gorilla">Eastern Lowland Gorilla</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="/Hominoidea/Hominidae/Homo">Homo</a>
          <ul>
            <li><a href="/Hominoidea/Hominidae/Homo/Homo Sapiens">Homo Sapiens</a>
              <ul>
                <li><a href="/Hominoidea/Hominidae/Homo/Homo Sapiens/Homo Sapiens Sapiens">Homo Sapiens Sapiens</a></li>
                <li><a href="/Hominoidea/Hominidae/Homo/Homo Sapiens/Homo Superior">Homo Superior</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="/Hominoidea/Hominidae/Pan">Pan</a>
          <ul>
            <li><a href="/Hominoidea/Hominidae/Pan/Common Chimpanzee">Common Chimpanzee</a></li>
            <li><a href="/Hominoidea/Hominidae/Pan/Bonobo">Bonobo</a></li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
</ul>

END;
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorXHTMLSelectedNodeLink1()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorXHTML();
        $visitor->options->selectedNodeLink = true;

        $tree->accept( $visitor );
        $expected = <<<END
  <ul>
    <li><a href="/Hylobatidae">Hylobatidae</a>
      <ul>
        <li><a href="/Hylobates">Hylobates</a>
          <ul>
            <li><a href="/Lar Gibbon">Lar Gibbon</a></li>
            <li><a href="/Agile Gibbon">Agile Gibbon</a></li>
            <li><a href="/Müller's Bornean Gibbon">Müller's Bornean Gibbon</a></li>
            <li><a href="/Silvery Gibbon">Silvery Gibbon</a></li>
            <li><a href="/Pileated Gibbon">Pileated Gibbon</a></li>
            <li><a href="/Kloss's Gibbon">Kloss's Gibbon</a></li>
          </ul>
        </li>
        <li><a href="/Hoolock">Hoolock</a>
          <ul>
            <li><a href="/Western Hoolock Gibbon">Western Hoolock Gibbon</a></li>
            <li><a href="/Eastern Hoolock Gibbon">Eastern Hoolock Gibbon</a></li>
          </ul>
        </li>
        <li><a href="/Symphalangus">Symphalangus</a></li>
        <li><a href="/Nomascus">Nomascus</a>
          <ul>
            <li><a href="/Black Crested Gibbon">Black Crested Gibbon</a></li>
            <li><a href="/Eastern Black Crested Gibbon">Eastern Black Crested Gibbon</a></li>
            <li><a href="/White-cheecked Crested Gibbon">White-cheecked Crested Gibbon</a></li>
            <li><a href="/Yellow-cheecked Gibbon">Yellow-cheecked Gibbon</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="/Hominidae">Hominidae</a>
      <ul>
        <li><a href="/Pongo">Pongo</a>
          <ul>
            <li><a href="/Bornean Orangutan">Bornean Orangutan</a></li>
            <li><a href="/Sumatran Orangutan">Sumatran Orangutan</a></li>
          </ul>
        </li>
        <li><a href="/Gorilla">Gorilla</a>
          <ul>
            <li><a href="/Western Gorilla">Western Gorilla</a>
              <ul>
                <li><a href="/Western Lowland Gorilla">Western Lowland Gorilla</a></li>
                <li><a href="/Cross River Gorilla">Cross River Gorilla</a></li>
              </ul>
            </li>
            <li><a href="/Eastern Gorilla">Eastern Gorilla</a>
              <ul>
                <li><a href="/Mountain Gorilla">Mountain Gorilla</a></li>
                <li><a href="/Eastern Lowland Gorilla">Eastern Lowland Gorilla</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="/Homo">Homo</a>
          <ul>
            <li><a href="/Homo Sapiens">Homo Sapiens</a>
              <ul>
                <li><a href="/Homo Sapiens Sapiens">Homo Sapiens Sapiens</a></li>
                <li><a href="/Homo Superior">Homo Superior</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="/Pan">Pan</a>
          <ul>
            <li><a href="/Common Chimpanzee">Common Chimpanzee</a></li>
            <li><a href="/Bonobo">Bonobo</a></li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>

END;
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorXHTMLSelectedNodeLink2()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorXHTML();
        $visitor->options->displayRootNode = true;
        $visitor->options->selectedNodeLink = true;

        $tree->accept( $visitor );
        $expected = <<<END
<ul>
<li>Hominoidea</li>
  <ul>
    <li><a href="/Hylobatidae">Hylobatidae</a>
      <ul>
        <li><a href="/Hylobates">Hylobates</a>
          <ul>
            <li><a href="/Lar Gibbon">Lar Gibbon</a></li>
            <li><a href="/Agile Gibbon">Agile Gibbon</a></li>
            <li><a href="/Müller's Bornean Gibbon">Müller's Bornean Gibbon</a></li>
            <li><a href="/Silvery Gibbon">Silvery Gibbon</a></li>
            <li><a href="/Pileated Gibbon">Pileated Gibbon</a></li>
            <li><a href="/Kloss's Gibbon">Kloss's Gibbon</a></li>
          </ul>
        </li>
        <li><a href="/Hoolock">Hoolock</a>
          <ul>
            <li><a href="/Western Hoolock Gibbon">Western Hoolock Gibbon</a></li>
            <li><a href="/Eastern Hoolock Gibbon">Eastern Hoolock Gibbon</a></li>
          </ul>
        </li>
        <li><a href="/Symphalangus">Symphalangus</a></li>
        <li><a href="/Nomascus">Nomascus</a>
          <ul>
            <li><a href="/Black Crested Gibbon">Black Crested Gibbon</a></li>
            <li><a href="/Eastern Black Crested Gibbon">Eastern Black Crested Gibbon</a></li>
            <li><a href="/White-cheecked Crested Gibbon">White-cheecked Crested Gibbon</a></li>
            <li><a href="/Yellow-cheecked Gibbon">Yellow-cheecked Gibbon</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="/Hominidae">Hominidae</a>
      <ul>
        <li><a href="/Pongo">Pongo</a>
          <ul>
            <li><a href="/Bornean Orangutan">Bornean Orangutan</a></li>
            <li><a href="/Sumatran Orangutan">Sumatran Orangutan</a></li>
          </ul>
        </li>
        <li><a href="/Gorilla">Gorilla</a>
          <ul>
            <li><a href="/Western Gorilla">Western Gorilla</a>
              <ul>
                <li><a href="/Western Lowland Gorilla">Western Lowland Gorilla</a></li>
                <li><a href="/Cross River Gorilla">Cross River Gorilla</a></li>
              </ul>
            </li>
            <li><a href="/Eastern Gorilla">Eastern Gorilla</a>
              <ul>
                <li><a href="/Mountain Gorilla">Mountain Gorilla</a></li>
                <li><a href="/Eastern Lowland Gorilla">Eastern Lowland Gorilla</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="/Homo">Homo</a>
          <ul>
            <li><a href="/Homo Sapiens">Homo Sapiens</a>
              <ul>
                <li><a href="/Homo Sapiens Sapiens">Homo Sapiens Sapiens</a></li>
                <li><a href="/Homo Superior">Homo Superior</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="/Pan">Pan</a>
          <ul>
            <li><a href="/Common Chimpanzee">Common Chimpanzee</a></li>
            <li><a href="/Bonobo">Bonobo</a></li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
</ul>

END;
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorXHTMLSelectedNodeLink3()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorXHTML();
        $visitor->options->displayRootNode = true;
        $visitor->options->selectedNodeLink = true;
        $visitor->options->basePath = 'testing';

        $tree->accept( $visitor );
        $expected = <<<END
<ul>
<li>Hominoidea</li>
  <ul>
    <li><a href="testing/Hylobatidae">Hylobatidae</a>
      <ul>
        <li><a href="testing/Hylobates">Hylobates</a>
          <ul>
            <li><a href="testing/Lar Gibbon">Lar Gibbon</a></li>
            <li><a href="testing/Agile Gibbon">Agile Gibbon</a></li>
            <li><a href="testing/Müller's Bornean Gibbon">Müller's Bornean Gibbon</a></li>
            <li><a href="testing/Silvery Gibbon">Silvery Gibbon</a></li>
            <li><a href="testing/Pileated Gibbon">Pileated Gibbon</a></li>
            <li><a href="testing/Kloss's Gibbon">Kloss's Gibbon</a></li>
          </ul>
        </li>
        <li><a href="testing/Hoolock">Hoolock</a>
          <ul>
            <li><a href="testing/Western Hoolock Gibbon">Western Hoolock Gibbon</a></li>
            <li><a href="testing/Eastern Hoolock Gibbon">Eastern Hoolock Gibbon</a></li>
          </ul>
        </li>
        <li><a href="testing/Symphalangus">Symphalangus</a></li>
        <li><a href="testing/Nomascus">Nomascus</a>
          <ul>
            <li><a href="testing/Black Crested Gibbon">Black Crested Gibbon</a></li>
            <li><a href="testing/Eastern Black Crested Gibbon">Eastern Black Crested Gibbon</a></li>
            <li><a href="testing/White-cheecked Crested Gibbon">White-cheecked Crested Gibbon</a></li>
            <li><a href="testing/Yellow-cheecked Gibbon">Yellow-cheecked Gibbon</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="testing/Hominidae">Hominidae</a>
      <ul>
        <li><a href="testing/Pongo">Pongo</a>
          <ul>
            <li><a href="testing/Bornean Orangutan">Bornean Orangutan</a></li>
            <li><a href="testing/Sumatran Orangutan">Sumatran Orangutan</a></li>
          </ul>
        </li>
        <li><a href="testing/Gorilla">Gorilla</a>
          <ul>
            <li><a href="testing/Western Gorilla">Western Gorilla</a>
              <ul>
                <li><a href="testing/Western Lowland Gorilla">Western Lowland Gorilla</a></li>
                <li><a href="testing/Cross River Gorilla">Cross River Gorilla</a></li>
              </ul>
            </li>
            <li><a href="testing/Eastern Gorilla">Eastern Gorilla</a>
              <ul>
                <li><a href="testing/Mountain Gorilla">Mountain Gorilla</a></li>
                <li><a href="testing/Eastern Lowland Gorilla">Eastern Lowland Gorilla</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="testing/Homo">Homo</a>
          <ul>
            <li><a href="testing/Homo Sapiens">Homo Sapiens</a>
              <ul>
                <li><a href="testing/Homo Sapiens Sapiens">Homo Sapiens Sapiens</a></li>
                <li><a href="testing/Homo Superior">Homo Superior</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="testing/Pan">Pan</a>
          <ul>
            <li><a href="testing/Common Chimpanzee">Common Chimpanzee</a></li>
            <li><a href="testing/Bonobo">Bonobo</a></li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
</ul>

END;
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorXHTMLXmlId()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorXHTML();
        $visitor->options->xmlId = 'tree_id';

        $tree->fetchNodeById( 'Hylobatidae' )->accept( $visitor );
        $expected = <<<END
  <ul id="tree_id">
    <li><a href="/Hylobatidae/Hylobates">Hylobates</a>
      <ul>
        <li><a href="/Hylobatidae/Hylobates/Lar Gibbon">Lar Gibbon</a></li>
        <li><a href="/Hylobatidae/Hylobates/Agile Gibbon">Agile Gibbon</a></li>
        <li><a href="/Hylobatidae/Hylobates/Müller's Bornean Gibbon">Müller's Bornean Gibbon</a></li>
        <li><a href="/Hylobatidae/Hylobates/Silvery Gibbon">Silvery Gibbon</a></li>
        <li><a href="/Hylobatidae/Hylobates/Pileated Gibbon">Pileated Gibbon</a></li>
        <li><a href="/Hylobatidae/Hylobates/Kloss's Gibbon">Kloss's Gibbon</a></li>
      </ul>
    </li>
    <li><a href="/Hylobatidae/Hoolock">Hoolock</a>
      <ul>
        <li><a href="/Hylobatidae/Hoolock/Western Hoolock Gibbon">Western Hoolock Gibbon</a></li>
        <li><a href="/Hylobatidae/Hoolock/Eastern Hoolock Gibbon">Eastern Hoolock Gibbon</a></li>
      </ul>
    </li>
    <li><a href="/Hylobatidae/Symphalangus">Symphalangus</a></li>
    <li><a href="/Hylobatidae/Nomascus">Nomascus</a>
      <ul>
        <li><a href="/Hylobatidae/Nomascus/Black Crested Gibbon">Black Crested Gibbon</a></li>
        <li><a href="/Hylobatidae/Nomascus/Eastern Black Crested Gibbon">Eastern Black Crested Gibbon</a></li>
        <li><a href="/Hylobatidae/Nomascus/White-cheecked Crested Gibbon">White-cheecked Crested Gibbon</a></li>
        <li><a href="/Hylobatidae/Nomascus/Yellow-cheecked Gibbon">Yellow-cheecked Gibbon</a></li>
      </ul>
    </li>
  </ul>

END;
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorXHTMLNoLinks()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $options = new ezcTreeVisitorXHTMLOptions;
        $options->addLinks = false;
        $visitor = new ezcTreeVisitorXHTML( $options );

        $tree->fetchNodeById( 'Hylobatidae' )->accept( $visitor );
        $expected = <<<END
  <ul>
    <li>Hylobates
      <ul>
        <li>Lar Gibbon</li>
        <li>Agile Gibbon</li>
        <li>Müller's Bornean Gibbon</li>
        <li>Silvery Gibbon</li>
        <li>Pileated Gibbon</li>
        <li>Kloss's Gibbon</li>
      </ul>
    </li>
    <li>Hoolock
      <ul>
        <li>Western Hoolock Gibbon</li>
        <li>Eastern Hoolock Gibbon</li>
      </ul>
    </li>
    <li>Symphalangus</li>
    <li>Nomascus
      <ul>
        <li>Black Crested Gibbon</li>
        <li>Eastern Black Crested Gibbon</li>
        <li>White-cheecked Crested Gibbon</li>
        <li>Yellow-cheecked Gibbon</li>
      </ul>
    </li>
  </ul>

END;
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorXHTMLSubtreeHighlightNodes()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $options = new ezcTreeVisitorXHTMLOptions;
        $options->subtreeHighlightNodeIds = array( 'Nomascus', 'Eastern Black Crested Gibbon' );
        $options->addLinks = false;
        $visitor = new ezcTreeVisitorXHTML( $options );

        $tree->fetchNodeById( 'Hylobatidae' )->accept( $visitor );
        $expected = <<<END
  <ul>
    <li>Hylobates
      <ul>
        <li>Lar Gibbon</li>
        <li>Agile Gibbon</li>
        <li>Müller's Bornean Gibbon</li>
        <li>Silvery Gibbon</li>
        <li>Pileated Gibbon</li>
        <li>Kloss's Gibbon</li>
      </ul>
    </li>
    <li>Hoolock
      <ul>
        <li>Western Hoolock Gibbon</li>
        <li>Eastern Hoolock Gibbon</li>
      </ul>
    </li>
    <li>Symphalangus</li>
    <li class="highlight">Nomascus
      <ul>
        <li>Black Crested Gibbon</li>
        <li class="highlight">Eastern Black Crested Gibbon</li>
        <li>White-cheecked Crested Gibbon</li>
        <li>Yellow-cheecked Gibbon</li>
      </ul>
    </li>
  </ul>

END;
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorXHTMLHighlightNodes()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $options = new ezcTreeVisitorXHTMLOptions;
        $options->highlightNodeIds = array( 'Nomascus', 'Eastern Black Crested Gibbon' );
        $options->addLinks = false;
        $visitor = new ezcTreeVisitorXHTML( $options );

        $tree->fetchNodeById( 'Hylobatidae' )->accept( $visitor );
        $expected = <<<END
  <ul>
    <li>Hylobates
      <ul>
        <li>Lar Gibbon</li>
        <li>Agile Gibbon</li>
        <li>Müller's Bornean Gibbon</li>
        <li>Silvery Gibbon</li>
        <li>Pileated Gibbon</li>
        <li>Kloss's Gibbon</li>
      </ul>
    </li>
    <li>Hoolock
      <ul>
        <li>Western Hoolock Gibbon</li>
        <li>Eastern Hoolock Gibbon</li>
      </ul>
    </li>
    <li>Symphalangus</li>
    <li><div class="highlight">Nomascus</div>
      <ul>
        <li>Black Crested Gibbon</li>
        <li><div class="highlight">Eastern Black Crested Gibbon</div></li>
        <li>White-cheecked Crested Gibbon</li>
        <li>Yellow-cheecked Gibbon</li>
      </ul>
    </li>
  </ul>

END;
        self::assertSame( $expected, $visitor->__toString() );
    }

    public static function suite()
    {
         return new PHPUnit_Framework_TestSuite( "ezcTreeVisitorXHTMLTest" );
    }
}

?>