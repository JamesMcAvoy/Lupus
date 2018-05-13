/**
 * Lycanthrope JS
 */

;((global, $) => {

    // Script default parameters
    // For example, the default input to send a message has the ID 'lt-send'
    let ltParams = {
        send: '#lyc-send'
    }

    let version = 'alpha'

    // Return a format str
    const printf = (string, args = []) => {
        for(i in args)
            string = string.replace('{' + i + '}', args[i])
        return string
    }

    // Return a boolean
    const isset = (attr) => {
        return (typeof attr !== 'undefined')
    }

    // Run Lycanthrope.dom()
    // Run Lycanthrope.connect()
    let init = function(args = {}) {
        if(isset(args.dom))
            this.dom(args.dom)
        this.connect(args)
    }

    // Set the default parameters from the inputs
    // If the parameter does exist, then it is created
    // Create the events related to the inputs
    let dom = function(args) {
        for(argument in args) {
            if(isset(ltParams[argument]) && $(args[argument]).length > 0)
                ltParams[argument] = args[argument]
        }

        let that = this
        // Send a message from the chat input
        $(ltParams.send).on('keypress', function(e) {
            if(e.keyCode == 13) {
                e.preventDefault()
                $this = $(this)
                if(that.socket && $this.val().length > 0) {
                    that.send($this.val())
                    $this.val('')
                }
            }
        })
    }

    // Instantiate a connection with the WS server
    // A CSRF token is needed
    // Additionnal route parameters are possible with routeArgs
    //
    // Example :
    //
    // Lycanthrope.connect({
    //      pseudo: 'user',
    //      token: 'token',
    //      socket: '127.0.0.1:8888',
    //      route: '/?pseudo={0}&token={1}&room={2}',
    //      routeArgs: ['id_room'],
    //      protocol: 'wss'
    // })
    let connect = function(args) {
        if(!isset(args.pseudo) || !isset(args.token)) {
            console.log('Erreur lors de la connexion : pseudo/token manquant')
            return
        }

        socket   = isset(args.socket)   ? args.socket   : '127.0.0.1:8888'
        route    = isset(args.route)    ? args.route    : '/?pseudo={0}&token={1}'
        protocol = isset(args.protocol) ? args.protocol : 'ws'

        let routeArgs
        // If parameter routeArgs does exist and route isn't the default route
        // Then a route with additionnal parameters is created
        if(isset(args.route) && isset(args.routeArgs)) {
            routeArgs = [args.pseudo, args.token].concat(args.routeArgs)
        } else {
            routeArgs = [args.pseudo, args.token]
        }

        route = protocol+'://'+socket+printf(route, routeArgs)

        try {
            this.socket = new WebSocket(route)
            this.socket.onopen    = onOpen
            this.socket.onclose   = onClose
            this.socket.onmessage = onMessage
            this.socket.onerror   = onError
        } catch(e) {
            console.error(e, e.stack)
            this.socket = false
        } finally {
            this.pseudo = args.pseudo
            this.token = args.token
        }
    }

    //
    let onOpen = function() {

    }

    //
    let onClose = function() {

    }

    //
    let onMessage = function(msg) {
        console.log(msg.data)
    }

    //
    let onError = function(e) {

    }

    // Message sending
    // Parameters : message and message type
    // Send a JSON stringified with pseudo and token
    let send = function(msg, type = 'MSG') {
        this.socket.send(JSON.stringify({
            msg: msg,
            type: type,
            user: {
                pseudo: this.pseudo,
                token: this.token
            }
        }))
    }

    // Main Lycanthrope object
    let main = {
        // this.socket
        // this.pseudo
        // this.token
        init: init,
        dom: dom,
        connect: connect,
        send: send,

        v: version
    }

    global.prototype.Lycanthrope = main

})(Window, jQuery)
