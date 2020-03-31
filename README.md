# tcexam2moodlexml

Migrate from TCExam Xml to Moodle Xml

### TCEXam XML
```xml
<?xml version="1.0" encoding="UTF-8" ?>
<tcexamquestions version="14.1.8">
  <header lang="it" date="2020-03-23 20:04:30">
  </header>
  <body>
    <module>
      <name>Questions name</name>
      <enabled>true</enabled>
      <subject>
        <name>Name</name>
        <description>Description</description>
        <enabled>true</enabled>
        <question>
          <enabled>true</enabled>
          <type>single</type>
          <difficulty>1</difficulty>
          <position></position>
          <timer>0</timer>
          <fullscreen>false</fullscreen>
          <inline_answers>false</inline_answers>
          <auto_next>false</auto_next>
          <description>Question text:</description>
          <explanation></explanation>
          <answer>
            <enabled>true</enabled>
            <isright>true</isright>
            <position></position>
            <keyboard_key></keyboard_key>
            <description>First right answer</description>
            <explanation></explanation>
          </answer>
          <answer>
            <enabled>true</enabled>
            <isright>false</isright>
            <position></position>
            <keyboard_key></keyboard_key>
            <description>Second wrong answer</description>
            <explanation></explanation>
          </answer>
          <answer>
            <enabled>true</enabled>
            <isright>false</isright>
            <position></position>
            <keyboard_key></keyboard_key>
            <description>Third wrong answer</description>
            <explanation></explanation>
          </answer>
        </question>
      </subject>
    </module>
  </body>
</tcexamquestions>
```


### Moodle XML
```xml
<?xml version="1.0" encoding="UTF-8"?>
<quiz>
  <question type="multichoice">
    <name>
      <text>question title</text>
    </name>
    <single>true</single>
    <shuffleanswers>true</shuffleanswers>
    <questiontext format="html">
      <text><![CDATA[<p>Question text:<br></p>]]></text>
    </questiontext>
    <answer fraction="100" format="html">
      <text><![CDATA[<p>First right answer<br></p>]]></text>
      <feedback format="html">
        <text></text>
      </feedback>
    </answer>
    <answer fraction="0" format="html">
      <text><![CDATA[<p>Second wrong answer<br></p>]]></text>
      <feedback format="html">
        <text></text>
      </feedback>
    </answer>
    <answer fraction="0" format="html">
      <text><![CDATA[<p>Third wrong answer<br></p>]]></text>
      <feedback format="html">
        <text></text>
      </feedback>
    </answer>
  </question>
</quiz>
```
