Usage
=====

Provides helper classes to use with Drupal paragraph type entities.
- [Paragraph Body](https://github.com/xcono/paragraph_body)
- [Paragraph Image](https://github.com/xcono/paragraph_image)
- [Paragraph Images](https://github.com/xcono/paragraph_images)
- [Paragraph Table](https://github.com/xcono/paragraph_table)

Installation
============

Install Paragraph Manager

```
# composer.json

{
    "repositories": [
        { "type": "vcs", "url": "https://github.com/xcono/paragraph_manager" },
    ],

    "require": {
        "xcono/paragraph_manager": "dev-master",
    },
}
```

Install with all paragraph type packages

```
# composer.json

"repositories": [
        { "type": "vcs", "url": "https://github.com/xcono/paragraph_manager" },
        { "type": "vcs", "url": "https://github.com/xcono/paragraph_image" },
        { "type": "vcs", "url": "https://github.com/xcono/paragraph_images" },
        { "type": "vcs", "url": "https://github.com/xcono/paragraph_body" },
        { "type": "vcs", "url": "https://github.com/xcono/paragraph_table" }
    ],
    "require": {
        "xcono/paragraph_manager": "dev-master",
        "xcono/paragraph_image": "dev-master",
        "xcono/paragraph_images": "dev-master",
        "xcono/paragraph_body": "dev-master",
        "xcono/paragraph_table": "dev-master"
    },

```