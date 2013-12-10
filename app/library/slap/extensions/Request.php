<?php namespace Slap\Extensions;

class Request extends \Illuminate\Http\Request {

    public function subdomain($max = 2, $ignore = 'www')
    {
        if ( ! $name =  $this->server('SERVER_NAME'))
        {
            throw new \OutOfBoundsException('The server has no SERVER_NAME!');
        }

        $segments = explode('.', $name);

        if (count($segments) > $max and $segments[0] !== $ignore)
        {
            return $segments[0];
        }

        return null;
    }

    // public function view()
    // {
    //     if (isset($this->server['REQUEST_URI']))
    //     {
    //         $a = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

    //         return implode('_', $a);
    //     }
    // }


}
