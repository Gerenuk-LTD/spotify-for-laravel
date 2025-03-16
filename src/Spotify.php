<?php

namespace Gerenuk\SpotifyForLaravel;

use Gerenuk\SpotifyForLaravel\Exceptions\ValidatorException;
use Gerenuk\SpotifyForLaravel\Helpers\Validator;

class Spotify
{
    private array $defaultConfig;

    public function __construct(array $defaultConfig)
    {
        $this->defaultConfig = $defaultConfig;
    }

    /**
     * Get Spotify catalog information for a single album.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-an-album
     */
    public function album(string $id): SpotifyRequest
    {
        $endpoint = '/albums/'.$id;

        $acceptedParams = [
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for multiple albums identified by their Spotify IDs.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-multiple-albums
     *
     * @throws ValidatorException
     */
    public function albums(array|string $ids): SpotifyRequest
    {
        $endpoint = '/albums';

        $acceptedParams = [
            'ids' => Validator::validateArgument('ids', $ids),
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information about an album’s tracks.
     * Optional parameters can be used to limit the number of tracks returned.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-an-albums-tracks
     */
    public function albumTracks(string $id): SpotifyRequest
    {
        $endpoint = '/albums/'.$id.'/tracks';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get a list of the albums saved in the current Spotify user's 'Your Music' library.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-users-saved-albums
     */
    public function currentUsersSavedAlbums(): SpotifyRequest
    {
        $endpoint = '/me/albums';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get a list of new album releases featured in Spotify (shown, for example, on a Spotify player’s “Browse” tab).
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-new-releases
     */
    public function newReleases(): SpotifyRequest
    {
        $endpoint = '/browse/new-releases';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for a single artist identified by their unique Spotify ID.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-an-artist
     */
    public function artist(string $id): SpotifyRequest
    {
        $endpoint = '/artists/'.$id;

        return new SpotifyRequest($endpoint);
    }

    /**
     * Get Spotify catalog information for several artists based on their Spotify IDs.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-multiple-artists
     *
     * @throws ValidatorException
     */
    public function artists(array|string $ids): SpotifyRequest
    {
        $endpoint = '/artists';

        $acceptedParams = [
            'ids' => Validator::validateArgument('ids', $ids),
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information about an artist’s albums.
     * Optional parameters can be specified in the query string to filter and sort the response.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-an-artists-albums
     */
    public function artistAlbums(string $id): SpotifyRequest
    {
        $endpoint = '/artists/'.$id.'/albums';

        $acceptedParams = [
            'include_groups' => null,
            'country' => $this->defaultConfig['country'],
            'limit' => null,
            'offset' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information about an artist’s top tracks by country.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-an-artists-top-tracks
     */
    public function artistTopTracks(string $id): SpotifyRequest
    {
        $endpoint = '/artists/'.$id.'/top-tracks';

        $acceptedParams = [
            'country' => $this->defaultConfig['country'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for a single audiobook.
     * Audiobooks are only available within the US, UK, Canada, Ireland, New Zealand and Australia markets.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-an-audiobook
     */
    public function audiobook(string $id): SpotifyRequest
    {
        $endpoint = '/audiobooks/'.$id;

        $acceptedParams = [
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for several audiobooks identified by their Spotify IDs.
     * Audiobooks are only available within the US, UK, Canada, Ireland, New Zealand and Australia markets.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-multiple-audiobooks
     *
     * @throws ValidatorException
     */
    public function audiobooks(array|string $ids): SpotifyRequest
    {
        $endpoint = '/audiobooks';

        $acceptedParams = [
            'ids' => Validator::validateArgument('ids', $ids),
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information about an audiobook's chapters.
     * Audiobooks are only available within the US, UK, Canada, Ireland, New Zealand and Australia markets.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-audiobook-chapters
     */
    public function audiobookChapters(string $id): SpotifyRequest
    {
        $endpoint = '/audiobooks/'.$id.'/chapters';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get a list of the audiobooks saved in the current Spotify user's 'Your Music' library.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-users-saved-audiobooks
     */
    public function currentUsersSavedAudiobooks(): SpotifyRequest
    {
        $endpoint = '/me/audiobooks';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get a single category used to tag items in Spotify (on, for example, the Spotify player’s “Browse” tab).
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-a-category
     */
    public function category(string $id): SpotifyRequest
    {
        $endpoint = '/browse/categories/'.$id;

        $acceptedParams = [
            'country' => $this->defaultConfig['country'],
            'locale' => $this->defaultConfig['locale'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get a list of categories used to tag items in Spotify (on, for example, the Spotify player’s “Browse” tab).
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-categories
     */
    public function categories(): SpotifyRequest
    {
        $endpoint = '/browse/categories';

        $acceptedParams = [
            'country' => $this->defaultConfig['country'],
            'locale' => $this->defaultConfig['locale'],
            'limit' => null,
            'offset' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for a single audiobook chapter.
     * Chapters are only available within the US, UK, Canada, Ireland, New Zealand and Australia markets.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-a-chapter
     */
    public function chapter(string $id): SpotifyRequest
    {
        $endpoint = '/chapters/'.$id;

        $acceptedParams = [
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for several audiobook chapters identified by their Spotify IDs.
     * Chapters are only available within the US, UK, Canada, Ireland, New Zealand and Australia markets.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-several-chapters
     *
     * @throws ValidatorException
     */
    public function chapters(array|string $ids): SpotifyRequest
    {
        $endpoint = '/chapters';

        $acceptedParams = [
            'ids' => Validator::validateArgument('ids', $ids),
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for a single episode identified by its unique Spotify ID.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-an-episode
     */
    public function episode(string $id): SpotifyRequest
    {
        $endpoint = '/episodes/'.$id;

        $acceptedParams = [
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for several episodes based on their Spotify IDs.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-an-episode
     *
     * @throws ValidatorException
     */
    public function episodes(array|string $ids): SpotifyRequest
    {
        $endpoint = '/episodes';

        $acceptedParams = [
            'ids' => Validator::validateArgument('ids', $ids),
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get a list of the episodes saved in the current Spotify user's library.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-users-saved-episodes
     */
    public function currentUsersSavedEpisodes(): SpotifyRequest
    {
        $endpoint = '/me/episodes';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get the list of markets where Spotify is available.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-available-markets
     */
    public function markets(): SpotifyRequest
    {
        $endpoint = '/markets';

        return new SpotifyRequest($endpoint);
    }

    /**
     * Get information about the user’s current playback state, including track or episode, progress, and active device.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-information-about-the-users-current-playback
     */
    public function playbackState(): SpotifyRequest
    {
        $endpoint = '/me/player';

        $acceptedParams = [
            'market' => $this->defaultConfig['market'],
            'additional_types' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get information about a user’s available Spotify Connect devices. Some device models are not supported and will not be listed in the API response.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-a-users-available-devices
     */
    public function availableDevices(): SpotifyRequest
    {
        $endpoint = '/me/player/devices';

        return new SpotifyRequest($endpoint);
    }

    /**
     * Get the object currently being played on the user's Spotify account.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-the-users-currently-playing-track
     */
    public function currentlyPlayingTrack(): SpotifyRequest
    {
        $endpoint = '/me/player/currently-playing';

        $acceptedParams = [
            'market' => $this->defaultConfig['market'],
            'additional_types' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    public function recentlyPlayedTracks(): SpotifyRequest
    {
        $endpoint = '/me/player/recently-played';

        $acceptedParams = [
            'limit' => null,
            'after' => null,
            'before' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get the list of objects that make up the user's queue.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-queue
     */
    public function currentUsersQueue(): SpotifyRequest
    {
        $endpoint = '/me/player/queue';

        return new SpotifyRequest($endpoint);
    }

    /**
     * Get a playlist owned by a Spotify user.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-playlist
     */
    public function playlist(string $id): SpotifyRequest
    {
        $endpoint = '/playlists/'.$id;

        $acceptedParams = [
            'fields' => null,
            'market' => $this->defaultConfig['market'],
            'additional_types' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get full details of the tracks of a playlist owned by a Spotify user.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-playlists-tracks
     */
    public function playlistTracks(string $id): SpotifyRequest
    {
        $endpoint = '/playlists/'.$id.'/tracks';

        $acceptedParams = [
            'fields' => null,
            'limit' => null,
            'offset' => null,
            'market' => $this->defaultConfig['market'],
            'additional_types' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get a list of the playlists owned or followed by the current Spotify user.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-a-list-of-current-users-playlists
     */
    public function currentUsersPlaylists(): SpotifyRequest
    {
        $endpoint = '/me/playlists';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get a list of the playlists owned or followed by a Spotify user.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-list-users-playlists
     */
    public function usersPlaylists(string $id): SpotifyRequest
    {
        $endpoint = '/users/'.$id.'/playlists';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get the current image associated with a specific playlist.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-playlist-cover
     */
    public function playlistCoverImage(string $id): SpotifyRequest
    {
        $endpoint = '/playlists/'.$id.'/images';

        return new SpotifyRequest($endpoint);
    }

    /**
     * Get Spotify Catalog information about artists, albums, tracks or playlists that match a keyword string.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/search
     *
     * @throws ValidatorException
     */
    public function searchItems(string $query, array|string $type): SpotifyRequest
    {
        $endpoint = '/search';

        $acceptedParams = [
            'q' => $query,
            'type' => Validator::validateArgument('type', $type),
            'market' => $this->defaultConfig['market'],
            'limit' => null,
            'offset' => null,
            'include_external' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for a single show identified by its unique Spotify ID.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-a-show
     */
    public function show(string $id): SpotifyRequest
    {
        $endpoint = '/shows/'.$id;

        $acceptedParams = [
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for several shows based on their Spotify IDs.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-multiple-shows
     *
     * @throws ValidatorException
     */
    public function shows(array|string $ids): SpotifyRequest
    {
        $endpoint = '/shows';

        $acceptedParams = [
            'ids' => Validator::validateArgument('ids', $ids),
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information about a show’s episodes.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-a-shows-episodes
     */
    public function showEpisodes(string $id): SpotifyRequest
    {
        $endpoint = '/shows/'.$id.'/episodes';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get a list of shows saved in the current Spotify user's library.
     * Optional parameters can be used to limit the number of shows returned.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-users-saved-shows
     */
    public function currentUsersSavedShows(): SpotifyRequest
    {
        $endpoint = '/me/shows';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for a single track identified by its unique Spotify ID.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-track
     */
    public function track(string $id): SpotifyRequest
    {
        $endpoint = '/tracks/'.$id;

        $acceptedParams = [
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get Spotify catalog information for multiple tracks based on their Spotify IDs.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-several-tracks
     *
     * @throws ValidatorException
     */
    public function tracks(array|string $ids): SpotifyRequest
    {
        $endpoint = '/tracks';

        $acceptedParams = [
            'ids' => Validator::validateArgument('ids', $ids),
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get a list of the songs saved in the current Spotify user's 'Your Music' library.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-users-saved-tracks
     */
    public function currentUsersSavedTracks(): SpotifyRequest
    {
        $endpoint = '/me/tracks';

        $acceptedParams = [
            'limit' => null,
            'offset' => null,
            'market' => $this->defaultConfig['market'],
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get detailed profile information about the current user (including the current user's username).
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-current-users-profile
     */
    public function currentUsersProfile(): SpotifyRequest
    {
        $endpoint = '/me';

        return new SpotifyRequest($endpoint);
    }

    /**
     * Get the current user's top artists or tracks based on calculated affinity.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-users-top-artists-and-tracks
     */
    public function currentUsersTopItems(string $type): SpotifyRequest
    {
        $endpoint = '/me/top/'.$type;

        $acceptedParams = [
            'time_range' => 'medium_term',
            'limit' => null,
            'offset' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }

    /**
     * Get public profile information about a Spotify user.
     */
    public function user(string $id): SpotifyRequest
    {
        $endpoint = '/users/'.$id;

        return new SpotifyRequest($endpoint);
    }

    /**
     * Get the current user's followed artists.
     *
     * @link https://developer.spotify.com/documentation/web-api/reference/get-followed
     */
    public function followedArtists(): SpotifyRequest
    {
        $endpoint = '/me/following';

        $acceptedParams = [
            'type' => 'artist',
            'after' => null,
            'limit' => null,
        ];

        return new SpotifyRequest($endpoint, $acceptedParams);
    }
}
