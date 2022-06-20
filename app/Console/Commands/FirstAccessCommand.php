<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FirstAccessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:first-access';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria o primeiro acesso ao sistema';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Qual seu nome?');
        $this->newLine();
        $email = $this->ask('Digite seu email');
        $this->newLine();
        $password = $this->secret('Digite uma senha');
        $this->newLine();
        $user = \App\Models\User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        $this->newLine();
        $this->info('Usuário criado com sucesso!');
        $this->newLine();
        $this->info('Acesse: http://localhost:8000/ para cadastrar suas tarefas.');
        return 0;
    }
}
