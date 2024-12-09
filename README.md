# jcr_writetab_author

Optionally assign an article to another author from within the `Write` panel.

---

The plugin adds an author select dropdown to the `Write` panel after the “Sort and Display” block.

## Installation

Download and copy the plugin code to the plugin installer textarea. Install and verify to begin the automatic setup. After activating the plugin, you will see an Author select dropdown in a new “Author” subsection of the sidebar in the Write panel.

## Troubleshooting

Q: I don’t see an author select dropdown

A: For the author select dropdown to appear, your site must have more than one author.

A: For security reasons, the author select dropdown is also only visible to users with sufficient rights to change users using the multi-edit dropdown on the "Articles" pane, and to users who are permitted to include PHP in articles. In a standard Textpattern setup these are the Publisher, Managing Editor and Copy Editor roles.

## Changelog

### 0.1.1 / 0.1.2 / 0.1.3 - 2024-12-09

- Restrict to users with 'admin.list' and 'article.php' privileges (thanks Oleg).
- Preset with current user when creating a new article (thanks Oleg).

### 0.1.0 - 2024-12-08

- Initial public release.
