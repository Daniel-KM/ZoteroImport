<?php
// Warning: the mapping is not one-to-one, so some data may be lost when the
// mapping is reverted. You may adapt it to your needs.

// https://www.zotero.org/support/kb/item_types_and_fields#item_types
return [
    'bibo:AcademicArticle'          => 'journalArticle',
    'bibo:Article'                  => 'newspaperArticle',
    'bibo:AudioDocument'            => 'audioRecording',
    'bibo:AudioVisualDocument'      => 'videoRecording',
    'bibo:Bill'                     => 'bill',
    'bibo:Book'                     => 'book',
    'bibo:BookSection'              => 'bookSection',
    'bibo:Brief'                    => 'document', // To check.
    'bibo:Chapter'                  => 'document', // To check.
    'bibo:Code'                     => 'document', // To check.
    'bibo:Collection'               => 'document', // To check.
    'bibo:CollectedDocument'        => 'document', // To check.
    'bibo:Conference'               => 'document', // To check.
    'bibo:CourtReporter'            => 'document', // To check.
    'bibo:Document'                 => 'document',
    'bibo:DocumentPart'             => 'document', // To check.
    'bibo:DocumentStatus'           => 'document', // To check.
    'bibo:EditedBook'               => 'book',
    'bibo:Email'                    => 'email',
    'bibo:Event'                    => 'document', // To check.
    'bibo:Excerpt'                  => 'document', // To check.
    'bibo:Film'                     => 'film',
    'bibo:Hearing'                  => 'hearing',
    'bibo:Image'                    => 'artwork',
    'bibo:Interview'                => 'interview',
    'bibo:Issue'                    => 'document', // To check.
    'bibo:Journal'                  => 'document', // To check.
    'bibo:LegalCaseDocument'        => 'case',
    'bibo:LegalDecision'            => 'document', // To check.
    'bibo:LegalDocument'            => 'document', // To check.
    'bibo:Legislation'              => 'document', // To check.
    'bibo:Letter'                   => 'letter',
    'bibo:Magazine'                 => 'document', // To check.
    'bibo:Manual'                   => 'document', // To check.
    'bibo:Manuscript'               => 'manuscript',
    'bibo:Map'                      => 'map',
    'bibo:MultiVolumeBook'          => 'document', // To check.
    'bibo:Newspaper'                => 'document', // To check.
    'bibo:Note'                     => 'note',
    'bibo:Patent'                   => 'patent',
    'bibo:Performance'              => 'document', // To check.
    'bibo:Periodical'               => 'document', // To check.
    'bibo:PersonalCommunication'    => 'instantMessage',
    'bibo:PersonalCommunicationDocument' => 'document', // To check.
    'bibo:Proceedings'              => 'conferencePaper',
    'bibo:Quote'                    => 'document', // To check.
    'bibo:ReferenceSource'          => 'document', // To check.
    'bibo:Report'                   => 'report',
    'bibo:Series'                   => 'document', // To check.
    'bibo:Slide'                    => 'document', // To check.
    'bibo:Slideshow'                => 'presentation',
    'bibo:Standard'                 => 'document', // To check.
    'bibo:Statute'                  => 'statute',
    'bibo:Thesis'                   => 'thesis',
    'bibo:ThesisDegree'             => 'document', // To check.
    'bibo:Webpage'                  => 'webpage',
    'bibo:Website'                  => 'document', // To check.
    'bibo:Workshop'                 => 'document', // To check.

    'dcterms:Agent'                 => 'document', // To check.
    'dcterms:AgentClass'            => 'document', // To check.
    'dcterms:BibliographicResource' => 'document', // To check.
    'dcterms:FileFormat'            => 'document', // To check.
    'dcterms:Frequency'             => 'document', // To check.
    'dcterms:Jurisdiction'          => 'document', // To check.
    'dcterms:LicenseDocument'       => 'document', // To check.
    'dcterms:LinguisticSystem'      => 'document', // To check.
    'dcterms:Location'              => 'document', // To check.
    'dcterms:LocationPeriodOrJurisdiction' => 'document', // To check.
    'dcterms:MediaType'             => 'document', // To check.
    'dcterms:MediaTypeOrExtent'     => 'document', // To check.
    'dcterms:MethodOfAccrual'       => 'document', // To check.
    'dcterms:MethodOfInstruction'   => 'document', // To check.
    'dcterms:PeriodOfTime'          => 'document', // To check.
    'dcterms:PhysicalMedium'        => 'document', // To check.
    'dcterms:PhysicalResource'      => 'document', // To check.
    'dcterms:Policy'                => 'document', // To check.
    'dcterms:ProvenanceStatement'   => 'document', // To check.
    'dcterms:RightsStatement'       => 'document', // To check.
    'dcterms:SizeOrDuration'        => 'document', // To check.
    'dcterms:Standard'              => 'document', // To check.

    'dctype:Collection'             => 'document', // To check.
    'dctype:Dataset'                => 'document', // To check.
    'dctype:Event'                  => 'document', // To check.
    'dctype:Image'                  => 'artwork',
    'dctype:InteractiveResource'    => 'document', // To check.
    'dctype:MovingImage'            => 'film',
    'dctype:PhysicalObject'         => 'document', // To check.
    'dctype:Service'                => 'document', // To check.
    'dctype:Software'               => 'computerProgram',
    'dctype:Sound'                  => 'audioRecording',
    'dctype:StillImage'             => 'artwork',
    'dctype:Text'                   => 'document', // To check.
];
