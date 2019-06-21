<div class="review_item">
    <div class="media">
        <div class="d-flex">
            <img src="{{ asset('img/product/review-1.png') }}" alt="">
        </div>
        <div class="media-body">
            <h4>{{ $user_name }}</h4>
            @for ($i = 1; $i <= $point; $i++)
                <i class="fa fa-star"></i>
            @endfor
        </div>
    </div>
    <p>{{ $review }}</p>
</div>
