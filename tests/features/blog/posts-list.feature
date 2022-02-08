Feature: Posts list
  I would like to load posts
  With different ordering, limit, per-page count
  Scenario Outline: Load 2 posts sorted descending by date
    Given There are posts:
      | title                    | slug                     | date                | published |
      | Aliquam a malesuada odio | aliquam-a-malesuada-odio | 2022-01-15 19:23:00 | 1         |
      | Sed sollicitudin         | sed-sollicitudin         | 2022-01-16 14:36:00 | 1         |
    When I load list of posts and I should receive <posts_count> posts sorted by "<sorting>"
    Examples:
      | posts_count | sorting  |
      |  2          |          |
      |  2          | date_asc |

#  Scenario: Load 2 posts sorted ascending by date
#    Given There are 2 posts
#    When I load list of posts and I should receive 2 posts sorted by "date_asc"
