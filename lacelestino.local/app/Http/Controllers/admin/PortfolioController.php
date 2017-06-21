<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Portfolio;
use App\Repositories\PortfolioRepository;
use App\Http\Requests\PortfolioRequest;

use Config;
use Gate;

class PortfolioController extends AdminController
{
    protected $portfolioRepository;
    
    public function __construct(
        PortfolioRepository $portfolioRepository
    ) {
        parent::__construct();
        $this->portfolioRepository = $portfolioRepository;
    }
    
    public function index()
    {
        $this->title = 'Список работ';
        if ( Gate::denies( 'view', new Portfolio ) ) {
            abort(403);
        }
        $portfolios = $this->portfolioRepository->getPortfolios( 
            Config::get( 'settings.pagginate_portfolios_admin' )
        );
        $this->out['content'] = view('admin.portfolio.content')->
            with(['portfolios' => $portfolios, 'denies' => $this->allDenies() ])->render();
        
        return $this->renderOutput();
    }
    
    private function allDenies() {
        return [
            'add' => Gate::denies( 'add', new Portfolio ),
            'update' => Gate::denies( 'update', new Portfolio ),
            'delete' => Gate::denies( 'delete', new Portfolio )
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( Gate::denies( 'add', new Portfolio ) ) {
            abort(403);
        }
        $this->title = "Добавить новую работу";
        $this->out['content'] = view('admin.portfolio.create')->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortfolioRequest $request)
    {
        if ( Gate::denies( 'add', new Portfolio ) ) {
            abort(403);
        }
        $result = $this->portfolioRepository->addPortfolio($request);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin/portfolios')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        if ( Gate::denies( 'update', new Portfolio ) ) {
            abort(403);
        }
        $portfolio->img = json_decode($portfolio->img);
        $this->title = 'Реадактирование материала - ' . $portfolio->title;
        $this->out['content'] = view('admin.portfolio.create')->
            with([
                'portfolio' => $portfolio
            ])->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PortfolioRequest $request, Portfolio $portfolio)
    {
        if ( Gate::denies( 'update', new Portfolio ) ) {
            abort(403);
        }
        $result = $this->portfolioRepository->updatePortfolio($request, $portfolio);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin/portfolios')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        if ( Gate::denies( 'delete', new Portfolio ) ) {
            abort(403);
        }
        $result = $this->portfolioRepository->deletePortfolio($portfolio);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin/portfolios')->with($result);
    }
    
}
