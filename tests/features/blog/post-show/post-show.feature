Feature: Post show
  I would like to load post by slug
  Post should be loaded if it was published
  Scenario Outline: Load published post by slug
    Given There are posts:
      | title                    | slug                     | date                | published |
      | Aliquam a malesuada odio | aliquam-a-malesuada-odio | 2022-01-15 19:23:00 | 1         |
      | Sed sollicitudin         | sed-sollicitudin         | 2022-01-16 14:36:00 | 1         |
    When I load post with slug <slug>
    Then I should receive post with slug <slug>
    Examples:
      | slug                      |
      |  aliquam-a-malesuada-odio |
      |  sed-sollicitudin         |

  Scenario Outline: Don't load unpublished post
    Given There are posts:
      | title               | slug                | date                | published |
      | Fusce blandit risus | fusce-blandit-risus | 2022-01-15 19:23:00 | 0         |
    When I load post with slug <slug>
    Then I should not receive post
    Examples:
      | slug                 |
      |  fusce-blandit-risus |
