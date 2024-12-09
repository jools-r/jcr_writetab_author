<?php
/**
 * jcr_writetab_author
 *
 * A Textpattern CMS plugin for setting the article author on the Write panel.
 */

global $event;

if (txpinterface === 'admin') {
    if ($event === 'article' && has_privs('admin.list') && has_privs('article.php')) {
        new jcr_writetab_author();
    }
}

class jcr_writetab_author
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        // Add article author UI region after sort_display block
        register_callback(function($event, $step, $default, $rs) {
            return $this->article_author_select($default, $rs);
        }, 'article_ui', 'sort_display', 0);

        // Amend author on article post/save
        register_callback(array($this, 'article_author_amend'), 'article_posted');
        register_callback(array($this, 'article_author_amend'), 'article_saved');
    }

    /**
     * Render article author select UI
     *
     * @param string  $default standard html output
     * @param array   $rs  article data
     * @return string HTML
     */

     protected function article_author_select($default, $rs)
    {
        $out="";
        $author = $rs['AuthorID'];
        $all_authors = array();

        foreach (safe_rows("name, RealName", 'txp_users', "1=1 ORDER BY RealName ASC") as $user) {
            extract($user);
            $all_authors[$name] = $RealName;
        }

        // Only output author select if the site has multiple authors
        if (count($all_authors) > 1) {
            $out = wrapRegion('txp-author-group',
                inputLabel(
                    'authorID',
                    selectInput('AuthorID', $all_authors, $author, false),
                    'author',
                    array('', 'instructions_authorID'),
                    array('class' => 'txp-form-field authorID')
                ),
                'txp-author-group-content',
                'author',
                'author'
            );
        }

        // Append output after sort_display block
        return $default.$out;
    }

    /**
     * Update article author on article post/save.
     *
     * @param string $event
     * @param string $step
     * @param array  $rs
     */

    public function article_author_amend($event, $step, $rs)
    {
        // Update author on save
        safe_update('textpattern', "AuthorID='".doSlash($rs['AuthorID'])."'", 'ID='.intval($rs['ID']));
    }

}
