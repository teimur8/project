<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClubAPIRequest;
use App\Http\Requests\API\UpdateClubAPIRequest;
use App\Models\Club;
use App\Repositories\ClubRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Http\Models\EloquentVueTables;
use Illuminate\Support\Facades\Auth;

/**
 * Class ClubController
 * @package App\Http\Controllers\API
 */

class ClubAPIController extends AppBaseController
{
    /** @var  ClubRepository */
    private $clubRepository;

    public function __construct(ClubRepository $clubRepo)
    {
        $this->clubRepository = $clubRepo;
    }

    /**
     * Display a listing of the Club.
     * GET|HEAD /clubs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = (new EloquentVueTables())->get(new Club(), ['id', 'name', 'city', 'address']);

        $data['success'] = true;
        $data['message'] = 'Successfully';

        return $data;
    }

    /**
     * Store a newly created Club in storage.
     * POST /clubs
     *
     * @param CreateClubAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateClubAPIRequest $request)
    {
        $input = $request->all();

        $clubs = $this->clubRepository->create($input);

        $clubs->users()->sync([ Auth::user()->id ]);


        return $this->sendResponse($clubs->toArray(), 'Club saved successfully');
    }

    /**
     * Display the specified Club.
     * GET|HEAD /clubs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Club $club */
        $club = $this->clubRepository->findWithoutFail($id, ['id','name','city','address']);

        if (empty($club)) {
            return $this->sendError('Club not found');
        }

        return $this->sendResponse($club->toArray(), 'Club retrieved successfully');
    }

    /**
     * Update the specified Club in storage.
     * PUT/PATCH /clubs/{id}
     *
     * @param  int $id
     * @param UpdateClubAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClubAPIRequest $request)
    {
        $input = $request->all();

        /** @var Club $club */
        $club = $this->clubRepository->findWithoutFail($id);

        if (empty($club)) {
            return $this->sendError('Club not found');
        }

        $club = $this->clubRepository->update($input, $id);

        return $this->sendResponse($club->toArray(), 'Club updated successfully');
    }

    /**
     * Remove the specified Club from storage.
     * DELETE /clubs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Club $club */
        $club = $this->clubRepository->findWithoutFail($id);

        if (empty($club)) {
            return $this->sendError('Club not found');
        }

        $club->delete();

        return $this->sendResponse($id, 'Club deleted successfully');
    }
}
