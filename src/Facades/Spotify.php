<?php

namespace Gerenuk\SpotifyForLaravel\Facades;

use Gerenuk\SpotifyForLaravel\SpotifyRequest;
use Illuminate\Support\Facades\Facade;

/**
 * @method static SpotifyRequest album(string $id)
 * @method static SpotifyRequest albums(array|string $ids)
 * @method static SpotifyRequest albumTracks(string $id)
 * @method static SpotifyRequest currentUsersSavedAlbums()
 * @method static SpotifyRequest newReleases()
 * @method static SpotifyRequest artist(string $id)
 * @method static SpotifyRequest artists(array|string $ids)
 * @method static SpotifyRequest artistAlbums(string $id)
 * @method static SpotifyRequest artistTopTracks(string $id)
 * @method static SpotifyRequest audiobook(string $id)
 * @method static SpotifyRequest audiobooks(array|string $ids)
 * @method static SpotifyRequest audiobookChapters(string $id)
 * @method static SpotifyRequest currentUsersSavedAudiobooks()
 * @method static SpotifyRequest category(string $id)
 * @method static SpotifyRequest categories()
 * @method static SpotifyRequest chapter(string $id)
 * @method static SpotifyRequest chapters(array|string $ids)
 * @method static SpotifyRequest episode(string $id)
 * @method static SpotifyRequest episodes(array|string $ids)
 * @method static SpotifyRequest currentUsersSavedEpisodes()
 * @method static SpotifyRequest markets()
 * @method static SpotifyRequest playbackState()
 * @method static SpotifyRequest availableDevices()
 * @method static SpotifyRequest currentlyPlayingTrack()
 * @method static SpotifyRequest recentlyPlayedTracks()
 * @method static SpotifyRequest currentUsersQueue()
 * @method static SpotifyRequest playlist(string $id)
 * @method static SpotifyRequest playlistTracks(string $id)
 * @method static SpotifyRequest currentUsersPlaylists()
 * @method static SpotifyRequest usersPlaylists(string $id)
 * @method static SpotifyRequest playlistCoverImage(string $id)
 * @method static SpotifyRequest searchItems(string $query, array|string $type)
 * @method static SpotifyRequest show(string $id)
 * @method static SpotifyRequest shows(array|string $ids)
 * @method static SpotifyRequest showEpisodes(string $id)
 * @method static SpotifyRequest currentUsersSavedShows()
 * @method static SpotifyRequest track(string $id)
 * @method static SpotifyRequest tracks(array|string $ids)
 * @method static SpotifyRequest currentUsersSavedTracks()
 * @method static SpotifyRequest currentUsersProfile()
 * @method static SpotifyRequest currentUsersTopItems(string $type)
 * @method static SpotifyRequest user(string $id)
 * @method static SpotifyRequest followedArtists()
 *
 * @see \Gerenuk\SpotifyForLaravel\Spotify
 */
class Spotify extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Gerenuk\SpotifyForLaravel\Spotify::class;
    }
}
