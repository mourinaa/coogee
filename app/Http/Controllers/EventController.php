<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Event;

class EventController extends Controller
{

 /**
  * Create Event
  *
  * @param  [string] name
  * @return [string] message
  */
  public function create(Request $request) {
    $request->validate([
        'title' => 'required|string',
        'url' => 'required|string',
        'event_date' => 'required|date',
    ]);

    $event = new Event([
        'title' => $request->title,
        'url' => $request->url,
        'event_date' => $request->event_date,
    ]);

    if ($event->save()){
        return response()->json([
            'message' => 'Successfully created event!'
        ], 201);
    }
    return response()->json([
        'error'=> 'Failure when creating event'
    ]);
  }



 /**
  * Update Event
  *
  * @param  [id] name
  * @return [string] message
  */

  public function update(Request $request) {
    // $eventAt = findEvent($id);
    $request->validate([
        'id' => 'required'
    ]);
    
    $eventId = $request->id;
    $eventAt = Event::find($eventId);

    if (!$eventAt) {
        return response()->json([
            'error'=> 'No Event Found'
        ], 405);
    }

    if ($eventAt->update($request->all())) {
        return response()->json([
            'data' => $eventAt
        ], 202);
    }

    return response()->json([
        'error'=> 'Failure Update Event'
    ], 403);

  }

  public function delete(Request $request, $id) {
    $eventAt = Event::find($id);
    if (!$eventAt) {
        return response()->json([
            'error'=> 'No Event Found'
        ], 405);
    }

    // if ($eventAt->delete($request->all())) {
    //     return response()->json([
    //         'data' => $eventAt
    //     ], 202);
    // }

    return response()->json([
        'error'=> 'TODO DELETE'
    ]);
  }


  // 👉 Try find event;
  public function findEvent($id) {
    $eventAt = Event::find($id);
    return $eventAt;
  }
}
