<?php
/**
 * PHPWord
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2014 PHPWord
 * @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt LGPL
 */

namespace PhpOffice\PhpWord\Writer\Word2007;

use PhpOffice\PhpWord\PhpWord;

/**
 * Word2007 contenttypes part writer
 */
class DocProps extends WriterPart
{
    /**
     * Write docProps/app.xml
     */
    public function writeDocPropsApp(PhpWord $phpWord = null)
    {
        if (is_null($phpWord)) {
            throw new Exception("No PhpWord assigned.");
        }

        // Create XML writer
        $xmlWriter = $this->getXmlWriter();

        // XML header
        $xmlWriter->startDocument('1.0', 'UTF-8', 'yes');

        // Properties
        $xmlWriter->startElement('Properties');
        $xmlWriter->writeAttribute('xmlns', 'http://schemas.openxmlformats.org/officeDocument/2006/extended-properties');
        $xmlWriter->writeAttribute('xmlns:vt', 'http://schemas.openxmlformats.org/officeDocument/2006/docPropsVTypes');

        // Application
        $xmlWriter->writeElement('Application', 'Microsoft Office Word');

        // ScaleCrop
        $xmlWriter->writeElement('ScaleCrop', 'false');

        // HeadingPairs
        $xmlWriter->startElement('HeadingPairs');

        // Vector
        $xmlWriter->startElement('vt:vector');
        $xmlWriter->writeAttribute('size', '4');
        $xmlWriter->writeAttribute('baseType', 'variant');

        // Variant
        $xmlWriter->startElement('vt:variant');
        $xmlWriter->writeElement('vt:lpstr', 'Theme');
        $xmlWriter->endElement();

        // Variant
        $xmlWriter->startElement('vt:variant');
        $xmlWriter->writeElement('vt:i4', '1');
        $xmlWriter->endElement();

        // Variant
        $xmlWriter->startElement('vt:variant');
        $xmlWriter->writeElement('vt:lpstr', 'Slide Titles');
        $xmlWriter->endElement();

        // Variant
        $xmlWriter->startElement('vt:variant');
        $xmlWriter->writeElement('vt:i4', '1');
        $xmlWriter->endElement();

        $xmlWriter->endElement();

        $xmlWriter->endElement();

        // TitlesOfParts
        $xmlWriter->startElement('TitlesOfParts');

        // Vector
        $xmlWriter->startElement('vt:vector');
        $xmlWriter->writeAttribute('size', '1');
        $xmlWriter->writeAttribute('baseType', 'lpstr');

        $xmlWriter->writeElement('vt:lpstr', 'Office Theme');

        $xmlWriter->endElement();

        $xmlWriter->endElement();

        // Company
        $xmlWriter->writeElement('Company', $phpWord->getDocumentProperties()->getCompany());

        // LinksUpToDate
        $xmlWriter->writeElement('LinksUpToDate', 'false');

        // SharedDoc
        $xmlWriter->writeElement('SharedDoc', 'false');

        // HyperlinksChanged
        $xmlWriter->writeElement('HyperlinksChanged', 'false');

        // AppVersion
        $xmlWriter->writeElement('AppVersion', '12.0000');

        $xmlWriter->endElement();

        // Return
        return $xmlWriter->getData();
    }


    /**
     * Write docProps/core.xml
     *
     * @param PhpWord $phpWord
     */
    public function writeDocPropsCore(PhpWord $phpWord)
    {
        // Create XML writer
        $xmlWriter = $this->getXmlWriter();

        // XML header
        $xmlWriter->startDocument('1.0', 'UTF-8', 'yes');

        // cp:coreProperties
        $xmlWriter->startElement('cp:coreProperties');
        $xmlWriter->writeAttribute('xmlns:cp', 'http://schemas.openxmlformats.org/package/2006/metadata/core-properties');
        $xmlWriter->writeAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1/');
        $xmlWriter->writeAttribute('xmlns:dcterms', 'http://purl.org/dc/terms/');
        $xmlWriter->writeAttribute('xmlns:dcmitype', 'http://purl.org/dc/dcmitype/');
        $xmlWriter->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');

        // dc:creator
        $xmlWriter->writeElement('dc:creator', $phpWord->getDocumentProperties()->getCreator());

        // cp:lastModifiedBy
        $xmlWriter->writeElement('cp:lastModifiedBy', $phpWord->getDocumentProperties()->getLastModifiedBy());

        // dcterms:created
        $xmlWriter->startElement('dcterms:created');
        $xmlWriter->writeAttribute('xsi:type', 'dcterms:W3CDTF');
        $xmlWriter->writeRaw(date(DATE_W3C, $phpWord->getDocumentProperties()->getCreated()));
        $xmlWriter->endElement();

        // dcterms:modified
        $xmlWriter->startElement('dcterms:modified');
        $xmlWriter->writeAttribute('xsi:type', 'dcterms:W3CDTF');
        $xmlWriter->writeRaw(date(DATE_W3C, $phpWord->getDocumentProperties()->getModified()));
        $xmlWriter->endElement();

        // dc:title
        $xmlWriter->writeElement('dc:title', $phpWord->getDocumentProperties()->getTitle());

        // dc:description
        $xmlWriter->writeElement('dc:description', $phpWord->getDocumentProperties()->getDescription());

        // dc:subject
        $xmlWriter->writeElement('dc:subject', $phpWord->getDocumentProperties()->getSubject());

        // cp:keywords
        $xmlWriter->writeElement('cp:keywords', $phpWord->getDocumentProperties()->getKeywords());

        // cp:category
        $xmlWriter->writeElement('cp:category', $phpWord->getDocumentProperties()->getCategory());

        $xmlWriter->endElement();

        // Return
        return $xmlWriter->getData();
    }
}
