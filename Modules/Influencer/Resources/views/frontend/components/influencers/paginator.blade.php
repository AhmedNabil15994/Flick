@if ($paginator->lastPage() > 1)
    <div class="pagination-container text-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                    <a class="page-link" style="cursor: pointer" onclick="getPaginate('{{$paginator->currentPage() - 1}}')"  aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @php 
                    $showPagesNumbers = 4;
                    if($paginator->lastPage() > $showPagesNumbers){
                        
                        if((($paginator->lastPage() - $paginator->currentPage()) > $showPagesNumbers)){

                            $startCounter = $paginator->currentPage();
                            $endCounter = $startCounter + $showPagesNumbers;
                        }else{

                            $startCounter = $paginator->lastPage() - $showPagesNumbers;
                            $endCounter = $paginator->lastPage();
                        }
                    }else{
                        $startCounter = 1;
                        $endCounter = $paginator->lastPage();
                    }

                    if($endCounter != $paginator->lastPage() || (($paginator->lastPage() - $paginator->currentPage()) > ($showPagesNumbers/2))){

                        for ($i = 2; $startCounter > 1 && $i > 0; $i--){
                            $startCounter --;
                            $endCounter -- ;
                        }
                    }
                @endphp

                @for ($i = $startCounter; $i <= $endCounter; $i++)
                    <li class="page-item">
                        <a class="page-link {{ ($paginator->currentPage() == $i) ? 'active' : '' }}" style="cursor: pointer" onclick="getPaginate('{{$i}}')">{{ $i }}</a>
                    </li>
                @endfor

                <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                    <a class="page-link" style="cursor: pointer" onclick="getPaginate('{{$paginator->currentPage() + 1}}')" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif
