<?php

namespace PushoverCli\Console;

use Elgentos\Parser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SendCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $name = 'send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a message to Pushover';
    protected $output;
    protected $input;
    protected $config;
    protected $quiet = false;
    protected $priority = 0;

    /**
     * @TODO implement --callback (for acknowledgement on prio 2)
     * @TODO implement device
     * @TODO implement sound
     *
     */
    protected function configure()
    {
        $this
            ->setName($this->name)
            ->setDescription($this->description)
            ->addArgument('message', null, 'The body of the message to be sent', '')
            ->addOption('title', 't', InputOption::VALUE_OPTIONAL, 'The title of the message to be sent')
            ->addOption('link', 'l', InputOption::VALUE_OPTIONAL, 'The link that accompanies the message', null)
            ->addOption('link-title', 'lt', InputOption::VALUE_OPTIONAL, 'The title for the link that accompanies the message', null)
            ->addOption('priority', 'p', InputOption::VALUE_OPTIONAL, 'The priority the message is to be sent with (0 is default, 1 is ignore quiet hours, 2 is repeat until acknowledged)', 0)
            ->addOption('token', null, InputOption::VALUE_OPTIONAL, 'The app token to be used - find in Pushover dashboard')
            ->addOption('user', null, InputOption::VALUE_OPTIONAL, 'The user token to be used - find in Pushover dashboard');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $this->config = $this->getConfig();

        $this->sendMessage();

        $this->output->writeln('Sending message; ' . $input->getArgument('message'));
    }

    /**
     * @return array
     */
    protected function getConfig(): array
    {
        $config = [];

        $fileLocations = [$_SERVER['HOME'], '.'];
        $filename = '.pushover.yaml';
        foreach ($fileLocations as $fileLocation) {
            if (file_exists($fileLocation . '/' . $filename)) {
                $config = array_merge($config, Parser::readFile($filename, $fileLocation));
            }
        }

        if (isset($config['quiet'])) {
            $this->priority = (int) $config['priority'];
        }

        return $config;
    }

    protected function sendMessage()
    {
        $message = new \Pushover();
        $message->setUser($this->config['user'] ?? $this->input->getOption('user'));
        $message->setToken($this->config['token'] ?? $this->input->getOption('token'));
        $message->setTitle($this->config['title'] ?? $this->input->getOption('title'));
        $message->setMessage($this->input->getArgument('message') ?? $this->input->getOption('title)'));
        $message->setPriority($this->config['priority'] ?? $this->input->getOption('priority'));
        $message->setUrl($this->input->getOption('link'));
        $message->setUrlTitle($this->input->getOption('link-title'));
        $message->send();
    }

}