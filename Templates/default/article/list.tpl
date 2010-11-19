{foreach from=$latestArticles->articles item=article}
<article>
    <a class="title" href="{$_root}/article/show/{$article->url}"> 
        <div class="date">{$article->timeAdded|date_format:"%e %B"}</div>
        <div class="titleText">{$article->title}</div>
        <div class="comments">
            <em>{$article->commentCount}</em>
        </div>
    </a>

    <ul class="tags">
        <li class="hidden"></li>
        {foreach from=$article->tags item=tag}
            <li>
                <a href="{$tag->link}">{$tag->tag}</a>
            </li>
        {/foreach} 
    </ul>

    <span>
        {if $article->contentPreview}
            {$article->contentPreview} 
            <strong>Continue reading</strong>
        {else}
            {$article->content}
        {/if}
    </span>
</article> <!-- article -->
{/foreach}

TODO: Pagination
