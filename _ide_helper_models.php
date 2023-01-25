<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\LflbApp
 *
 * @property integer $id
 * @property string $_oldid
 * @property string $name
 * @property string $orgId
 * @property string $description
 * @property string $image
 * @property string $categories
 * @property string $categories_old
 * @property string $mapCenterAddress
 * @property string $mapCenterAddressCoords_lat
 * @property string $mapCenterAddressCoords_lng
 * @property string $mainColor
 * @property string $secondaryColor
 * @property string $created_at
 * @property string $updated_at
 * @property LflbStory[] $lflbStories
 * @property-read int|null $lflb_stories_count
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp query()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereCategoriesOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereMainColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereMapCenterAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereMapCenterAddressCoordsLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereMapCenterAddressCoordsLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereSecondaryColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbApp whereUpdatedAt($value)
 */
	class LflbApp extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LflbAsset
 *
 * @property integer $id
 * @property string $_oldid
 * @property string $orgId
 * @property string $link
 * @property string $originalImage
 * @property string $type
 * @property string $text
 * @property string $cleanText
 * @property string $name
 * @property string $caption
 * @property string $tags
 * @property string $thumbnail
 * @property string $created_at
 * @property string $updated_at
 * @property LflbStoryPart[] $lflbStoryParts
 * @property-read int|null $lflb_story_parts_count
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset query()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereCleanText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereOriginalImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbAsset whereUpdatedAt($value)
 */
	class LflbAsset extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LflbCategory
 *
 * @property integer $id
 * @property string $_oldid
 * @property string $title
 * @property string $description
 * @property string $coverPhoto
 * @property string $sub_categories_old
 * @property string $sub_categories
 * @property string $featured
 * @property string $introText
 * @property string $bodyText
 * @property string $mainImage
 * @property string $created_at
 * @property string $updated_at
 * @property LflbSubCategory[] $lflbSubCategories
 * @property-read int|null $lflb_sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereBodyText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereCoverPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereIntroText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereSubCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereSubCategoriesOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbCategory whereUpdatedAt($value)
 */
	class LflbCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LflbMetadatum
 *
 * @property integer $id
 * @property string $_oldid
 * @property string $contributor
 * @property string $creator
 * @property string $description
 * @property string $format
 * @property string $identifier
 * @property string $language
 * @property string $publisher
 * @property string $relation
 * @property string $rights
 * @property string $source
 * @property string $subject
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum query()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereContributor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereCreator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum wherePublisher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereRights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbMetadatum whereUpdatedAt($value)
 */
	class LflbMetadatum extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LflbStory
 *
 * @property integer $id
 * @property integer $app_id
 * @property string $_oldid
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $imageUrl
 * @property string $categories_old
 * @property string $categories
 * @property string $startDay
 * @property string $startMonth
 * @property string $startYear
 * @property string $endDay
 * @property string $endMonth
 * @property string $endYear
 * @property string $locationName
 * @property string $location_lat
 * @property string $location_lng
 * @property string $metaData
 * @property string $created_at
 * @property string $updated_at
 * @property LflbApp $lflbApp
 * @property LflbStoryPart[] $lflbStoryParts
 * @property LflbTag[] $lflbTags
 * @property-read int|null $lflb_story_parts_count
 * @property-read int|null $lflb_tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory query()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereCategoriesOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereEndDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereEndMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereEndYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereLocationLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereLocationLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereLocationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereStartDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereStartMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereStartYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStory whereUpdatedAt($value)
 */
	class LflbStory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LflbStoryPart
 *
 * @property integer $id
 * @property integer $story_id
 * @property integer $asset_id
 * @property string $_oldid
 * @property string $caption
 * @property boolean $position
 * @property string $annotations
 * @property string $created_at
 * @property string $updated_at
 * @property LflbStory $lflbStory
 * @property LflbAsset $lflbAsset
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart query()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart whereAnnotations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbStoryPart whereUpdatedAt($value)
 */
	class LflbStoryPart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LflbSubCategory
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $_oldid
 * @property string $title
 * @property string $stories
 * @property string $stories_old
 * @property string $subTitle
 * @property string $mainImage
 * @property boolean $position
 * @property string $created_at
 * @property string $updated_at
 * @property LflbCategory $lflbCategory
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory whereStories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory whereStoriesOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbSubCategory whereUpdatedAt($value)
 */
	class LflbSubCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LflbTag
 *
 * @property integer $id
 * @property integer $story_id
 * @property string $_oldid
 * @property string $storyid
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property LflbStory $lflbStory
 * @method static \Illuminate\Database\Eloquent\Builder|LflbTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|LflbTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbTag whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbTag whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbTag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LflbTag whereValue($value)
 */
	class LflbTag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Membership
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUserId($value)
 */
	class Membership extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Team
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $personal_team
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TeamInvitation[] $teamInvitations
 * @property-read int|null $team_invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\TeamFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team wherePersonalTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
 */
	class Team extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TeamInvitation
 *
 * @property int $id
 * @property int $team_id
 * @property string $email
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereUpdatedAt($value)
 */
	class TeamInvitation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property string $title
 * @property int $amount
 * @property string $status
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $date_for_editing
 * @property-read mixed $date_for_humans
 * @property-read mixed $status_color
 * @method static \Database\Factories\TransactionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

