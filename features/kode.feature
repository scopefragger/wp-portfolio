Feature: ls
  Scenario:
    Given I am on "/Users/mark/Documents/kode-gallery-portfolio/kodeportfolio.php"
    When i run "init"
    Then I should get (string)