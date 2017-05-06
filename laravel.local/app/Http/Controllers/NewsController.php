<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\News;
use App\Countries;
use App\Libs\Number;

class NewsController extends Controller
{
    protected $out;
    private $limit = 5;

    public function index() {
        $this->out['header'] = "Все новости";
        $this->out['onpage'] = $this->limit;
        $this->out['urlpagging'] = route('viewall',['p'=>'']);
        
        $offset = Number::preparePagging($this->out);
        $this->out['news'] = News::select(['id','title','content','created_at'])->skip($offset)->take($this->limit)->get();
        $this->out['total_stat'] = News::count();
        $this->out['pagging'] = Number::pagging($this->out['total_stat'], $this->out['onpage']);

        return view('news.index')->with('out', $this->out);
    }
    
    public function view($id) {
        $this->out['header'] = "Одна новость";
        $this->out['news'] = News::join('countries', 'news.country_id', '=', 'countries.id')
                ->select(['news.*', 'countries.title as c_title'])
                ->where('news.id',(int)$id)->first();
        
//        $this->out['news'] = News::select(['id','title','content','created_at'])->where('id',(int)$id)->first();
        $this->out['canEdit'] = false;
        if (Auth::user()) {
            $this->out['canEdit'] = true;
        }

        return view('news.view')->with('out', $this->out);
    }
    
    public function add() {
        $this->out['header'] = "Добавить новость";
        $this->out['urlmode'] = route('addnews');
        $user = Auth::user();
        if (!$user) {
            $this->out['noAccess'] = 1;
            return view('noAccess')->with('out', $this->out);
        }
        $this->out['countries'] = Countries::select(['id','title','abbr'])->get();

        return view('news.add')->with('out', $this->out);
    }
    
    public function addnews(Request $request) {
        $this->out['header'] = "Добавить новость";
        $news = new News;
        $this->validate($request, $news->rules);
        $news->fill($request->all()); 
        $news->country_id = (int)$request->all()['country'];
        $news->save();

        return redirect('news/');;
    }
    
    public function edit($id) {
        $this->out['header'] = "Редактировать новость";
        $this->out['urlmode'] = route('edit',['id'=>(int)$id]);
        $user = Auth::user();
        if (!$user) {
            $this->out['noAccess'] = 1;
            return view('noAccess')->with('out', $this->out);
        }
        $news = News::select()->where('id',(int)$id)->first();
        if (!$news) {
            $this->out['noAccess'] = 1;
            return view('noAccess')->with('out', $this->out);
        }
        //$this->validate($news, $news->rules);
        
        $this->out['countries'] = Countries::select(['id','title','abbr'])->get();

        return view('news.add')->with('out', $this->out);
    }
    
    public function editnews($id, Request $request) {
        $this->out['header'] = "Редактировать новость";
        $id = (int)$id;
        $news = News::find($id);
        if ($news) {
            $this->validate($request, $news->rules);
            $news->fill($request->all()); 
            $news->update();
            $this->out['editsuccess'] = true;
        } 
        $this->out['urlmode'] = route('edit',['id'=>(int)$id]);
        $this->out['countries'] = Countries::select(['id','title','abbr'])->get();

        return view('news.add')->with('out', $this->out);
    }


}
