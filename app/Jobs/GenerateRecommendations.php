<?php

namespace App\Jobs;

use App\User;
use App\Recommender;
use App\Rating;
use App\RecommendationOnRating;
use Illuminate\Support\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateRecommendations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $last_login;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $last_login)
    {
        //
        $this->user = $user;
        $this->last_login = $last_login;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //

        if (count($this->user->ratings) > 0) {

            if (!is_null($this->last_login)) {

                //we generate recommendations every minute after login offset is one minute, we can set this to 24 hrs
                $userLastLogin = Carbon::parse($this->last_login);
                $lastLoginOffset = $userLastLogin->addMinutes(1); //addHours(12);


                $recommender = null;
                $recommendations = null;

                if ($lastLoginOffset->lt(now())) {

                    //generate recommendation
                    $recommender = new Recommender();
                    $recommendations = $recommender->recommendationOnRatingsForUser(Rating::all(), $this->user->id);

                    $serializeData = serialize($recommendations);
                    //add or update to recommendations table
                    $record = $this->user->recommendationOnRating()->firstOrCreate(['user_id' => $this->user->id]);

                    $record->update(['recommendation_on_ratings' => $serializeData]);

                    $this->user->last_login = now();
                    $this->user->save();

                    echo ('lastLoginOffset < now() == true : a record does/doesnt exist, add the record');

                    return;
                } else {
                    //do not generate recommendation
                    echo ('lastLoginOffset < now() == false : do not generate recommendation');
                    return;
                }
            } else {
                //user field last login is null, still generate recommendation

                //generate recommendation
                $recommender = new Recommender();
                $recommendations = $recommender->recommendationOnRatingsForUser(Rating::all(), $this->user->id);

                $serializeData = serialize($recommendations);


                //add or update to recommendations table
                $record = $this->user->recommendationOnRating()->firstOrCreate(['user_id' => $this->user->id]);

                $record->update(['recommendation_on_ratings' => $serializeData]);

                $this->user->last_login = now();
                $this->user->save();
                echo ('last_login field is null(probably a new user), add the record');

                return;
            }
        } else {
            //user don't have rating or ratings is less than treshhold
            //for recommendation to be generated
            echo ('user dont have rating or ratings is less than treshhold');
            return;
        }
    }
}
