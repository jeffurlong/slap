<?php namespace Controllers\Admin;

use View, Input, Redirect;
use Controllers\BaseController;
use Slap\Validators\PageValidator;
use Slap\Repositories\Interfaces\PageRepositoryInterface;


class PageController extends BaseController {

	/**
     * Repository
     * @var Page
     */
    private $pages;

	/**
     * Validator
     * @var Validator
     */
    private $validator;

    /**
     * Constructor
     * @param PageRepositoryInterface   $pages
     * @param PageValidator             $validator
     */
	public function __construct(PageRepositoryInterface $pages, PageValidator $validator)
	{
        $this->beforeFilter('auth-admin');

		$this->pages = $pages;

		$this->validator = $validator;

		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		return View::make('admin.pages.index', array('pages' => $this->pages->all()));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.pages.form', array('page' => $this->pages->instance()));
	}

	/**
	 * Store a newly created resource in storage.
	 * @return Response
	 */
	public function store()
	{
		if ( ! $this->validator->validate())
        {
            return Redirect::back()->withInput()->withErrors($this->validator->errors());
        }

        $this->pages->create(Input::all());

		return Redirect::to('/admin/pages')->with('alert', 'Your page has been saved');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('admin.pages.form', array('page' => $this->pages->find($id)));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if ( ! $this->validator->validate())
        {
            return Redirect::back()->withInput()->withErrors($this->validator->errors());
        }

        $this->pages->update(Input::all());

		return Redirect::to('/admin/pages')->with('alert', 'Your page has been saved');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->pages->destroy($id);

		return Redirect::to('/admin/pages')->with('alert', 'The page has been deleted');
	}


	/**
	 * Delete the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$this->pages->delete($id);

		return Redirect::to('/admin/pages')->with('alert', 'The page has been deleted');
	}

}
