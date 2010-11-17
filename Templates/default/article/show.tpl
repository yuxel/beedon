<article>
    <a class="title"> 
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
