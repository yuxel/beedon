{foreach from=$latestArticles item=article}
<article>
    <a class="title" href="{$_root}/article/show/{$article->url}"> 
        <div class="date">{$article->time|date_format:"%e %B"}</div>
        <div class="titleText">{$article->title}</div>
        <div class="comments">
            <em>{$article->commentCount}</em>
        </div>
    </a>
    <span>
        {$article->text}
    </span>
</article> <!-- article -->
{/foreach}

TODO: Pagination
