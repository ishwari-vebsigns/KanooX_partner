<!DOCTYPE html>
<html>
<head>
  <title>My Web Page</title>
  <link rel="stylesheet" type="text/css" href="sweetalert2.min.css">
  <script type="text/javascript" src="sweetalert2.all.min.js"></script>
  <style>
    body {
      margin: 0;
    }

    .articles {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: stretch;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
    }
    
    article {
      position: relative;
      width: 300px; /* Fixed width for the card */
      height: 471px; /* Fixed height for the card */
      border-radius: 16px;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
      background: #dbe5ff;
      overflow: hidden;
      margin-bottom: 24px;
      margin-top: 60px;
    }

    article:before {
      content: "";
      position: absolute;
      top: -16px;
      left: -16px;
      right: -16px;
      bottom: -16px;
      background-color: #fff;
      z-index: -1;
      border-radius: inherit;
      box-shadow: inherit;
    }
    
    .article-wrapper {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }
    
    figure {
      margin: 0;
      padding: 0;
      aspect-ratio: 10/3;
      overflow: hidden;
    }
    
    article img {
      max-width: 100%;
      height: auto;
      margin-bottom: 15px; /* Add margin-bottom to create a gap */
    }
    
    .article-body {
      margin-top: 12px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 20px; /* Adjusted padding values */
      text-align: center;
    }
    
    h2 {
      margin-top: 23px;
    }
  </style>
  <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=64622830d427210019483886&product=inline-share-buttons&source=platform" async="async"></script>

  <script type="text/javascript" src="script.js"></script>
</head>
<body>
  <section class="articles">
    <article>
      <div class="article-wrapper">
        <figure>
          <img src="{{$base_url}}/login-images/logo.png" alt="" />
        </figure>
        <div class="article-body">
          {!! htmlspecialchars_decode($agentqrc->agent_qr->qr_code) !!}
          <h2>{{$agentqrc->name}}</h2>
          
        </div>
        
      </div>
    </article>
  </section>
  <!-- AddToAny BEGIN -->
  @if(Auth::user()!=null)
  <div class="sharethis-inline-share-buttons"></div>
  @endif
  <!-- AddToAny END -->

</body>
</html>
