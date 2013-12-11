<?php namespace Controllers\Admin;
use View, Input, Redirect;
use Slap\Repositories\Interfaces\Page as Repo;
use \Slap\Validators\Page as Validator;

class PageController extends \Controllers\BaseController {

	/**
     * Repository
     * @var Page
     */
    private $repo;

	/**
     * Validator
     * @var Validator
     */
    private $validator;

    /**
     * Constructor
     * @param Repo      $repo
     * @param Validator $validator
     */
	public function __construct(Repo $repo, Validator $validator)
	{
        $this->beforeFilter('auth-admin');

		$this->repo 		= $repo;

		$this->validator 	= $validator;

		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		return View::make('admin.pages.index', array('pages' => $this->repo->all()));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.pages.form', array('page' => $this->repo->instance()));
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

        $this->repo->create(Input::all());

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
		return View::make('admin.pages.form', array('page' => $this->repo->find($id)));
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

        $this->repo->update(Input::all());

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
		$this->repo->destroy($id);

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
		$this->repo->delete($id);

		return Redirect::to('/admin/pages')->with('alert', 'The page has been deleted');
	}

}
